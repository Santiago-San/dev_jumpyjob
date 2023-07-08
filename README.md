# JumpyJobs
## Setup Larave Project
- Download and Install Laragon: https://laragon.org/download/
- Start (all) Laragon Services, important for us: PHP/Apache, MySQL
- To create a new project: Laragon -> Menu -> Quick App -> Laravel: Enter project name - A Laravel Project will be created. The project directory can be found at c:/laragon/www/{project_name}
#after that fallow these steps 
#step 1 . Install composer in your local/server machine 
#step 2. composer install => will install all dependancy of my project 
#if step 2 not working then run composer update , after that run composer install
#step 3. php artisan key:generate => for security resion , laravel create own key 
#step 4 php artisan migrate => for setup database 
#step 5 php artisan db:seed=> insert demo if we set 
#step 6. php artisan serve => create vartual host for run my project 
