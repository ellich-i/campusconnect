# CampusConnect Test Cases

Last updated: 2026-10-25

| # | Test case | How we tested | Evidence | Done |
|---|-----------|---------------|----------|------|
| 1 | Valid registration and login | Registered on /register, then logged in | evidence/test01_register_login.png | ⬜ |
| 2 | Invalid input and duplicate email | Registered with an email that already exists | evidence/test02_duplicate_email.png | ⬜ |
| 3 | Guests cannot open protected pages | Logged out, opened /events, got sent to /login | evidence/test03_guest_redirect.png | ⬜ |
| 4 | Students cannot open admin pages | Student opened /admin, got 403 | evidence/test_403_admin.png | ✅ |
| 5 | Students cannot edit others' events | Student opened /events/2/edit, got 403 | evidence/test_403_edit.png | ✅ |
| 6 | Invalid schedule rejected | UPDATE with end_time = start_time, blocked by events_time_check | evidence/test06_invalid_schedule.png | ✅ |
| 7 | Duplicate registration rejected | Second INSERT hit UNIQUE(event_id, user_id) | evidence/test07_duplicate_join.png | ✅ |
| 8 | Cannot join a full event | Third user joined Sketch Hour (2 slots), got "This event is full." | evidence/test08_full_event.png | ✅ |
| 9 | Leaving updates participation | Clicked Leave, slots left went back up | evidence/test09_leave.png | ⬜ |
| 10 | Filters return correct events | Filtered /events by category | evidence/test10_filter.png | ⬜ |
| 11 | Foreign keys block invalid references | INSERT event with organizer_id 999 | evidence/test11_foreign_key.png | ✅ |
| 12 | DB privileges block unauthorized operations | campus_app tried CREATE, DROP, ALTER, TRUNCATE in tinker, all denied | evidence/privilege_test.png | ✅ |
| 13 | Trigger logs status changes | Cancelled an event, checked event_status_logs | evidence/test13_trigger_log.png | ⬜ |
| 14 | Backup restores successfully | restore.ps1 into campusconnect_test, row counts match | evidence/restore_proof.png | ✅ |
| 15 | Clean migrate and seed works | php artisan migrate:fresh --seed --database=pgsql_owner | evidence/test15_seed.png | ⬜ |

## Database administration evidence

| Item | Evidence |
|------|----------|
| EXPLAIN before index (Seq Scan, 25.476 ms) | evidence/explain_before.png |
| EXPLAIN after index (Index Scan, 0.405 ms) | evidence/explain_after.png |
| 16 | Wrong login page is rejected | Student account on /admin-login | evidence/test16_wrong_login_page.png | ⬜ |
| 17 | Duplicate location name gives a friendly error | Admin adds "Library" again | evidence/test17_duplicate_location.png | ⬜ |