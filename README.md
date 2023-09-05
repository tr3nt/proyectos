## Projects

### Installation

1. Clone repository
```bash
git clone https://github.com/tr3nt/proyectos.git
```
2. Run composer
```bash
composer install
```
3. Put DB connection values in **.env** file
4. Run migrations
```bash
php artisan migrate
```
```bash
php artisan db:seed
```
5. Run NPM
```bash
npm install
```
```bash
npm run dev
```

### DONE
Backend:
- Migrations and seeder working
- Users registration, login and logout. They can be tested using Rapid API Client or Postman.
- Alpine, Laravel, Livewire and Tailwind implemented.
- Protected routes by Bearer Token with Laravel Sanctum.

### TODO
1. All the Frontend.
2. Backend:
- Projects integration with Livewire.

### Created by
Esaim Najera Mondragon