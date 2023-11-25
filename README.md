# BookStore App - Development Case Study

The BookStore App is a simple application developed with Laravel by using the [development philosophy](DEVELOPMENT_PHILOSOPHY.md).

Architecture: https://drive.google.com/file/d/1MF9hVbmX7j1iBes2lJbMIY_MWPaNE2yT/view?usp=sharing

## Requirements

- PHP 8.2
- Composer 2.6

## Getting Started

1. Clone the repository.
2. Rename or copy the `bookstore-app/.env-example` to `bookstore-app/.env`.
3. Update the `.env` with the database credentials.
4. Run `php artisan migrate` to run the database migrations.
5. Start the server with `php artisan serve`.

> Seed the fake data by running `php artisan migrate:fresh --seed`.
