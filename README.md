# Praktikum Pemrograman Web - Tugas 4 - Todo App

This project is a submission for the Web Practicum Tugas 4 assignment. It is a full-stack To-Do list application built with PHP and MySQL, featuring user authentication, session management, and full CRUD operations.

## Features

- Authentication: Full user registration and login system with session management.

- CRUD: Full Create, Read, Update, and Delete functionality for To-Do items.

- Security: Uses prepared statements in the controller for all database operations to prevent SQL injection.

- Filtering: The dashboard includes features to search for tasks and filter by status (All, Done, Pending).

## How to Run This Project

### 1. Database Setup

Navigate to the `/database` directory.
Import the `tugas4_if-j.sql` file into your MySQL management tool (like phpMyAdmin).

### 2. Configuration

In the `/config` directory, find the file `db_config.example.php`.

Make a copy of this file in the same folder and rename it to `db_config.php`.

Open `db_config.php` and update the constants (`DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, `DB_NAME`) to match your local MySQL setup. Make sure `DB_NAME` is set to `tugas4_if-j`.

### 3. Running the Application

Once the database and credentials are set up, open the project's root folder in your browser. The `index.php` file will automatically redirect you to the main dashboard.
