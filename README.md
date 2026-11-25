# NovinGym

REST API for NovinGym, a tool for gym coaches. A coach registers their gym, builds workout programs for trainees from an exercise library, and downloads each program as a printable PDF.

This is the second version of the project, rebuilt as a modular Laravel 11 app. The first version is in [NovinGym](https://github.com/abolfazlhp10/NovinGym).

Full endpoint reference: [API_DOCUMENTATION.md](API_DOCUMENTATION.md)

## Features

**Coaches**
- Register with their gym details (name, logo, address)
- Log in with a one-time code sent by SMS (FarazSMS), or with a password
- Token authentication with Laravel Sanctum
- Create, edit and delete workout programs for trainees, with the trainee's name, phone number and the exercises for each day
- Download a program as an A4 PDF, ready to print
- Browse the exercise library by category and equipment
- Send feedback and read the FAQ

**Admins**
- Role-based access with spatie/laravel-permission (`admin` and `coach`)
- Manage exercise categories, equipment and exercises (Persian and English name, demo video, description)
- See all programs
- Manage FAQs and read coach feedback

## Tech stack

- PHP 8.2, Laravel 11
- nwidart/laravel-modules (modular structure)
- Laravel Sanctum, spatie/laravel-permission
- spatie/laravel-pdf for PDF programs
- morilog/jalali for Persian (Jalali) dates
- vinkla/hashids for public IDs
- FarazSMS for OTP messages
- Laravel Pint for code style

## Project structure

Each feature is a module under `Modules/`, with its own routes, controllers, services, models, migrations and API resources. Routes are versioned under `/api/V1`.

```
Modules/
  User/      registration, OTP and password login, gyms, roles
  Exercise/  categories, equipment and exercises
  Program/   workout programs and PDF download
  Support/   FAQ and feedback
```

## Running locally

Requirements: PHP 8.2+, Composer, Node.js (used by the PDF renderer), and MySQL or SQLite.

```bash
git clone https://github.com/abolfazlhp10/novin-gym.git
cd novin-gym
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Set your database in `.env`. For SMS login, also set:

```env
SMS_DRIVER=farazsms
FARAZSMS_USERNAME=
FARAZSMS_PASSWORD=
FARAZSMS_FROM=
FARAZSMS_PATTERN_CODE=
```

Then create the tables and roles, and start the server:

```bash
php artisan migrate
php artisan db:seed --class="Modules\User\Database\Seeders\RoleSeeder"
php artisan storage:link
php artisan serve
```

The API is served at `http://localhost:8000/api/V1`.
