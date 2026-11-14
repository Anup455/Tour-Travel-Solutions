# Wanderly tour and travel project

React + Vite frontend, Core PHP JSON APIs and MySQL schema. The frontend includes home, about, tour listing with search/price filter, trip details, registration/login, booking request, booking history, contact form, and an admin dashboard overview.

## Run locally with XAMPP

1. Use PHP 8.1 or newer, then copy `tour-travel-backend` into `C:\xampp\htdocs\tour-travel-backend`.
2. Start Apache and MySQL in XAMPP.
3. Import `tour-travel-backend/tour_travel_db.sql` using phpMyAdmin. It creates the database and sample records.
4. Confirm Apache's PHP settings allow file uploads up to 5 MB (`upload_max_filesize`) and the `tour-travel-backend/uploads` folder is writable by Apache.
5. Open a terminal in `tour-travel-frontend`, run `npm install`, then `npm run dev`.
6. Visit `http://localhost:5173`. The API defaults to `http://localhost/tour-travel-backend/api`.

Database defaults are XAMPP's `root` with an empty password. Set `DB_HOST`, `DB_NAME`, `DB_USER`, and `DB_PASS` environment variables to override them. Set `VITE_API_URL` in the frontend `.env` file to override the API base URL.

## Admin setup

Register a user, then promote it in phpMyAdmin: `UPDATE users SET role='admin' WHERE email='your@email.example';`. Sign in and visit `/admin`. No default plaintext admin password is installed.

The SQL seed includes five demo accounts (`avery@example.test`, `jordan@example.test`, `sam@example.test`, `taylor@example.test`, and `morgan@example.test`); each uses the password `password`. Promote the Avery account for a ready-to-use local admin by running `UPDATE users SET role='admin' WHERE email='avery@example.test';` after importing the database. Change demo credentials before sharing the site.

## Main files and APIs

- `src/App.jsx`: page routes, shared navigation and forms.
- `src/style.css`: responsive styling.
- `src/services/api.js`: Axios API client.
- `config/database.php`: PDO connection.
- `middleware/bootstrap.php`: sessions, JSON helpers, CORS and role checks.
- `api/auth`: register, login, logout, session, and profile endpoints.
- `api/packages`: public package list and details.
- `api/destinations/index.php`: public active destination list.
- `api/bookings`: create and view own bookings.
- `api/contact/create.php`: save contact enquiry.
- `api/admin`: dashboard, package/destination create/edit/delete, protected image upload, user activation, booking status changes and contact messages.
- `tour_travel_db.sql`: five tables, eight destinations, thirteen packages, five sample users and sample bookings.

The package table also stores editable itinerary, accommodation, and transportation notes so trip details can be maintained from the admin screen.

Admin endpoints are protected by the session role. Image uploads are restricted to JPEG, PNG and WebP, with a 5 MB limit and randomized filenames. Replace sample imagery, sample data, and placeholder company contact details for a real business. The frontend needs internet access for its remote Unsplash images. Configure the allowed frontend origin and HTTPS cookie settings before public deployment.
