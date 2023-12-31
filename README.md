## Projects 2.0

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
7. Mailer Configuration .env file
```bash
QUEUE_CONNECTION=database
...
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=yourUsername
MAIL_PASSWORD=yourPassword
```
8. Run mail queue listener
```bash
php artisan queue:work
```
9. Users for test login
- u: esaim.najera@gmail.com | p: 12345678
- u: john@gmail.com | p: 12345678

### DONE
#### Backend:
- Migrations and seeder working.
- Users registration, login and logout.
- Create, list, show and update Projects.
- Laravel, Livewire, Tailwind and Alpinejs implemented.
- Protected routes with Laravel Auth.
- Frontend public and logged sections.
- Added Testing cases.
- Created **SendMailJob** job and **ProjectUpdate** mailable.
- Observers on updating and deleting
- Changed foreign key from id_created_by to users_id (must run php artisan migrate:refresh)
- Removed try catch, Validator instances and added flash messages
- Used Storage class to save the image of a new register
- Changed Mailable to send after 10 min only when status change (using observer)
#### Frontend:
- Created mosaic and animations with Alpinejs on Guest section

### TODO

### Created by
Esaim Najera Mondragon