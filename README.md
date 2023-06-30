# JumpyJobs
## Setup on Windows
- Download and Install Laragon: https://laragon.org/download/
- Start (all) Laragon Services, important for us: PHP/Apache, MySQL
- To create a new project: Laragon -> Menu -> Quick App -> Laravel: Enter project name - A Laravel Project will be created. The project directory can be found at c:/laragon/www/{project_name}
- To launch Project: *php artisan serve* - to access the project in the browser: {project_name}.test
- To make MySQL Migrations (for the first time this creates the database): *php artisan migrate*
- To add PHPMyAdmin: Laragon -> Menu -> Tools -> Quick Add -> *phpmyadmin. <br> localhost/phpmyadmin will open it in the browser. User: root, Password: leave empty
