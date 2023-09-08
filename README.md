## Projects 1.0

### Installation

1. Clone repository
```bash
git clone https://github.com/tr3nt/proyectos.git
```
2. Run composer
```bash
composer install
```
3. Put DB connection values in a new **.env** file (Linux example)
```bash
cp .env.example .env
```
4. Run migrations, seeders and permissions
```bash
php artisan migrate
```
```bash
php artisan db:seed
```
```bash
php artisan key:generate
```
```bash
php artisan storage:link
```
5. Run NPM
```bash
npm install
```
```bash
npm run dev
```
6. Run Test cases
```bash
php artisan test
```
7. Users for test login
- u: esaim.najera@gmail.com | p: 12345678
- u: john@gmail.com | p: 12345678

### DONE
Backend:
- Migrations and seeder working
- Users registration, login and logout.
- Create, list, show and update Projects
- Laravel, Livewire and Tailwind implemented.
- Protected routes with Laravel Auth.
- Frontend public and logged sections
- Added Testing cases

### TODO
- 2hr sleep to send an automatic mail
- Alpine integration.

### Created by
Esaim Najera Mondragon