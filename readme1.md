## Project Creation 
These are the information/commands you need to know when starting a laravel project for a backend API

**Create a project**
- composer global require laravel/installer
- laravel new example-app

**ENV-APP_KEY:**
- php artisan key:generate

**Install API**
- php artisan install:api

**Composer:**
- composer install

**Database:**
This will drop the tables, run the migration, and will run the seed
- php artisan migrate:fresh --seed


## Frequently used Artisan Commands

**Start local server**
- php artisan serve

**View Route list**
- php artisan route:list

**Model creation**
- php artisan make:model Flight --migration

**Model creation with migration**
- php artisan make:model Flight --migration

**Controller creation**
- php artisan make:controller UserController

**Controller creation with Resource**
- php artisan make:controller PhotoController --resource

**Controller creation with Resource route model binding**
- php artisan make:controller PhotoController --model=Photo --resource

**Controller creation with Resource route model binding**
- php artisan make:controller PhotoController --model=Photo --resource --requests

**Middleware creation**
- php artisan make:middleware EnsureTokenIsValid

**Model creation**
- php artisan make:job ProcessPodcast

**Job creation**
- php artisan make:job ProcessPodcast

**Mail creation**
- php artisan make:mail ForgotPassword

**Running Queues**
- php artisan queue:work

**Resource Creation (for single model)**
- php artisan make:resource User

**Resource Collection Creation**
- php artisan make:resource UserCollection