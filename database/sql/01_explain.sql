-- EXPLAIN demo for the discovery page query (COMP 018, indexes and query plans).
-- Method: insert 50,000 fake events, run EXPLAIN without the index, then with it.
-- Fake rows were deleted after the demo.

-- Query used by EventController::index (upcoming open events, soonest first)
EXPLAIN (ANALYZE, BUFFERS)
SELECT * FROM events
WHERE status = 'open' AND event_date >= CURRENT_DATE
ORDER BY event_date, start_time
LIMIT 9;

-- RESULTS (50,002 rows)
-- BEFORE (no index): Seq Scan, 48,104 rows removed by filter,
--                    1056 buffers, Execution Time 25.476 ms
-- AFTER  (index):    Index Scan on events_event_date_status_index,
--                    Incremental Sort, 67 buffers, Execution Time 0.405 ms
--
-- Index created by the migration:
-- CREATE INDEX events_event_date_status_index ON events (event_date, status);