# CampusConnect ERD

```mermaid
erDiagram
    users ||--o{ events : organizes
    categories ||--o{ events : classifies
    locations ||--o{ events : hosts
    users ||--o{ event_participants : joins
    events ||--o{ event_participants : has
    events ||--o{ event_status_logs : audited_by

    users {
        bigint id PK
        varchar name
        varchar email UK
        varchar password
        varchar role "CHECK: student or admin"
    }
    categories {
        bigint id PK
        varchar name UK
        text description
    }
    locations {
        bigint id PK
        varchar name UK
    }
    events {
        bigint id PK
        bigint organizer_id FK
        bigint category_id FK
        bigint location_id FK
        varchar title
        text description
        date event_date
        time start_time
        time end_time
        int capacity "CHECK: greater than 0"
        varchar status "CHECK: open, cancelled, completed"
    }
    event_participants {
        bigint id PK
        bigint event_id FK
        bigint user_id FK
        timestamp joined_at
    }
    event_status_logs {
        bigint id PK
        bigint event_id FK
        varchar old_status
        varchar new_status
        timestamp changed_at
    }
      locations {
        bigint id PK
        varchar name UK
        text description "nullable, added by a separate migration"
    }
```

**Notes**
- `event_participants` has UNIQUE(event_id, user_id), so nobody can join twice.
- `events` has CHECK(end_time > start_time).
- Deletes: events to users, categories, locations are RESTRICT. event_participants and event_status_logs are CASCADE.
- `event_status_logs` is filled by the trigger `trg_event_status_log`, not by Laravel.
- Laravel framework tables (cache, jobs, sessions, migrations, etc.) are left out.