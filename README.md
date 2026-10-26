# CampusConnect

**A Student-Driven System for Productive Vacant Hours**
*"Vacant hours? Connect, engage in campus fun activities."*

A web app where PUP Calauan students create, discover, and join student-led campus activities (study sessions, art meetups, peer circles). Built for COMP 016 (Web Development) and COMP 018 (Database Administration) Midterm Project, Phase 1.

**Group members:** [Abache], [Rebato]

## Tech stack

| Layer | Tool |
|-------|------|
| Backend | Laravel 13 (PHP 8.3) |
| Database | PostgreSQL 18 |
| Frontend | Blade templates, HTML, CSS, JavaScript (Vite, Tailwind from Breeze) |
| Auth | Laravel Breeze (Blade) |

## Features

- **Students:** register, log in, browse upcoming events, filter by category, location and date, create and manage their own events, join and leave events, and see their created and joined events on a dashboard.
- **Admins:** protected dashboard, manage categories and locations (full CRUD), change user roles, cancel or remove inappropriate events.
- **Rules enforced on the server and in the database:** no double registration, no joining a full event, organizer cannot join their own event, capacity cannot go below current participants, invalid schedules are rejected.

## Two kinds of roles (do not mix them up)

| | Application roles | PostgreSQL roles |
|---|---|---|
| Where | `users.role` column | Database server |
| Values | `student`, `admin` | `campus_owner`, `campus_app`, `campus_backup` |
| Controls | What a person can do in the website | What the code can do to the database |
| Enforced by | `auth` and `admin` middleware, `EventPolicy` | PostgreSQL privileges |

## Setup on a new computer

**Requirements:** Git, PHP 8.3 (with `zip`, `pdo_pgsql`, `pgsql` extensions enabled in php.ini), Composer, Node.js, PostgreSQL 18, pgAdmin.

```powershell
git clone https://github.com/ellich-i/campusconnect.git
cd campusconnect
composer install
npm install
copy .env.example .env
php artisan key:generate
```

**Create the database and roles.** Open `database/sql/00_setup.sql` in pgAdmin and run each PART separately. Change the placeholder passwords first.

**Fill in `.env`** with the passwords you chose:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=campusconnect
DB_USERNAME=campus_app
DB_PASSWORD="your app password"
DB_OWNER_USERNAME=campus_owner
DB_OWNER_PASSWORD="your owner password"
```

**Build the tables and sample data, then run:**

```powershell
php artisan migrate:fresh --seed --database=pgsql_owner
npm run build
php artisan serve
```

Open http://127.0.0.1:8000. For frontend work, run `npm run dev` in a second terminal.

> **Why `--database=pgsql_owner`?** The app normally connects as `campus_app`, which can only read and write rows (it cannot create, alter, or drop tables). Migrations need the owner role. This is the least privilege design: if the website is ever compromised, the attacker cannot destroy the database structure.

### Demo accounts (seeded, for demo only)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@campusconnect.test | password |
| Student | student@campusconnect.test | password |

## Database design

ERD: [docs/erd.md](docs/erd.md)

| Table | Purpose | Key constraints |
|-------|---------|-----------------|
| `users` | Accounts | `email` UNIQUE, CHECK `role IN ('student','admin')` |
| `categories` | Event categories | `name` UNIQUE |
| `locations` | Campus places | `name` UNIQUE, `description` nullable |
| `events` | Student activities | FKs to users, categories, locations (RESTRICT), CHECK `capacity > 0`, CHECK `end_time > start_time`, CHECK status in (open, cancelled, completed) |
| `event_participants` | Many-to-many users and events | UNIQUE(`event_id`, `user_id`), FKs (CASCADE) |
| `event_status_logs` | Audit trail | Filled by a trigger |

### Design decisions and reasons

| Decision | Reason | Alternative and trade-off |
|----------|--------|---------------------------|
| `role` is a column, not a roles table | Only two fixed roles. A CHECK constraint is enough | A roles table is more flexible but needs extra joins for no benefit here |
| Available slots are **not stored** | It is derived data: `capacity - COUNT(participants)`. Storing it creates two sources of truth that can drift apart (update anomaly) | Storing it is faster to read at huge scale, but risky and more code |
| Separate `locations` table | Free text gives "Library", "library", "Liblary" and breaks the location filter (3NF, one fact in one place) | Plain text column is simpler but unreliable |
| Events are cancelled, not deleted, when they have participants | Keeps history. The FK uses RESTRICT so users, categories and locations in use cannot be deleted | Hard delete is simpler but loses history |
| Pivot table has its own `id` plus UNIQUE pair | Easier with Eloquent, still blocks duplicates | A composite primary key is also valid |
| `organizer_id` and `status` are not mass-assignable | The server sets them. A user cannot fake the owner or status through a form | Making them fillable would allow mass assignment attacks |

### Index and EXPLAIN

Index: `events (event_date, status)`. It supports the discovery page query (upcoming open events, soonest first). Tested with 50,000 generated events (removed after the demo).

| | Plan | Buffers | Execution time |
|---|------|---------|----------------|
| Without index | Seq Scan, 48,104 rows removed by filter | 1056 | 25.476 ms |
| With index | Index Scan + Incremental Sort, 62 rows read | 67 | 0.405 ms |

Trade-off: reads are faster, but every INSERT and UPDATE must also update the index and it uses extra space. Worth it because the discovery page is the most common query. Queries: [database/sql/01_explain.sql](database/sql/01_explain.sql). Screenshots: `docs/evidence/explain_before.png` and `explain_after.png`.

### Trigger

`trg_event_status_log` runs after an UPDATE of `events.status`. It calls the PL/pgSQL function `log_event_status_change()`, which inserts a row into `event_status_logs` (old status, new status, time). The audit happens in the database, so it works no matter who changes the status (Laravel, pgAdmin, another script). Defined in the migration `create_event_status_trigger`.

### PostgreSQL roles and privileges

| Role | Used for | Privileges |
|------|----------|------------|
| `campus_owner` | Migrations only | Owns the database and tables |
| `campus_app` | The Laravel app (default connection `pgsql`) | CONNECT, USAGE on schema, SELECT/INSERT/UPDATE/DELETE on tables, USAGE on sequences |
| `campus_backup` | `pg_dump` backups | Read-only (`pg_read_all_data`) |

Proof: in tinker as `campus_app`, CREATE TABLE, DROP TABLE, ALTER TABLE and TRUNCATE are all denied (`docs/evidence/privilege_test.png`).

### Backup and restore

```powershell
# Backup (asks for the campus_backup password). Output goes to database\backups\
powershell -ExecutionPolicy Bypass -File database\scripts\backup.ps1

# Restore proof: restores the newest backup into a separate database
# (campusconnect_test) and compares row counts with the real database
powershell -ExecutionPolicy Bypass -File database\scripts\restore.ps1
```

Backups use `pg_dump -F c` (custom format: compressed, works with `pg_restore`). The restore goes to a different database so the real data is never touched. Result: row counts matched in all 6 tables, and the trigger and CHECK constraints were restored too (`docs/evidence/restore_proof.png`). Backup files are not committed to Git (they contain user data).

## How the code is organized (MVC request flow)

Example: a student clicks **Join**.

1. **Route** `POST /events/{event}/join` (`routes/web.php`), inside the `auth` middleware group
2. **Middleware** checks the user is logged in
3. **Controller** `EventParticipationController@join` opens a DB transaction and locks the event row with `lockForUpdate()`, so two students cannot take the last slot at the same time
4. **Model** `Event` and its `participants()` relationship are used to check status, ownership, duplicates and capacity, then `attach()` inserts the row
5. **Database** UNIQUE(`event_id`, `user_id`) is the final safety net
6. **View** `events/show.blade.php` shows the result (display only, no business logic)

| Folder | Contents |
|--------|----------|
| `app/Http/Controllers` | `EventController`, `EventParticipationController`, `DashboardController`, `Admin/*` |
| `app/Http/Requests` | Form Requests for validation (`StoreEventRequest`, `UpdateEventRequest`, `CategoryRequest`) |
| `app/Http/Middleware` | `EnsureUserIsAdmin` (alias `admin`) |
| `app/Policies` | `EventPolicy` (only the organizer or an admin can edit) |
| `app/Models` | `User`, `Event`, `Category`, `Location` with Eloquent relationships |
| `database/migrations` | Tables, constraints, indexes, trigger |
| `database/seeders` | Demo data |
| `database/sql`, `database/scripts` | Setup SQL, EXPLAIN queries, backup and restore scripts |

## Security notes

- Passwords are hashed by Laravel.
- Authorization is enforced on the server (middleware and policy). Hiding a button is not security: a student who types `/events/2/edit` or `/admin` gets a 403.
- Mass assignment is blocked with `$fillable`. `role`, `organizer_id` and `status` cannot be set from a form.
- Every form has a CSRF token.
- Database CHECK, UNIQUE and FOREIGN KEY constraints are a second lock behind Laravel validation.

## Testing

15 test cases with evidence: [docs/TESTING.md](docs/TESTING.md)

## Out of scope

Real-time chat, AI matching, payments, GPS maps, push notifications, mobile apps.

## Known limitations

- Row-level security (RLS) is not implemented. Access control is done with PostgreSQL role privileges and Laravel policies.
- Backups are run by hand. In a real deployment they would be scheduled and copied to another machine.
- Demo accounts use a simple password and must not be used in production.

### Two login pages

Students log in at `/student-login` and admins at `/admin-login`. The role of the account must match the page, otherwise the login is rejected (and counted as a failed attempt for rate limiting). This is only for clearer entry points. The real protection is the `auth` and `admin` middleware on every admin route, so typing `/admin` as a student still gives 403.

### Why a separate migration for `locations.description`

`description` was added later with its own migration (`add_description_to_locations_table`) instead of editing the original one, because a migration that already ran on a database must not be changed. A new migration upgrades existing databases safely.