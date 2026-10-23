-- CampusConnect database setup. Run each part separately in pgAdmin.

-- PART 1 (connected to "postgres" database): create roles.
-- Replace the passwords. Never commit real passwords.
CREATE ROLE campus_owner LOGIN PASSWORD 'CHANGE_ME_OWNER';
CREATE ROLE campus_app   LOGIN PASSWORD 'CHANGE_ME_APP';

-- PART 2 (still "postgres" database): create the database.
CREATE DATABASE campusconnect OWNER campus_owner;

-- PART 3 (connected to "campusconnect" database): privileges.
REVOKE ALL ON DATABASE campusconnect FROM PUBLIC;
GRANT CONNECT ON DATABASE campusconnect TO campus_app;
GRANT USAGE ON SCHEMA public TO campus_app;

ALTER DEFAULT PRIVILEGES FOR ROLE campus_owner IN SCHEMA public
  GRANT SELECT, INSERT, UPDATE, DELETE ON TABLES TO campus_app;
ALTER DEFAULT PRIVILEGES FOR ROLE campus_owner IN SCHEMA public
  GRANT USAGE, SELECT ON SEQUENCES TO campus_app;