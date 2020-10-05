## tech-test

-   Set up your .env file for a laravel installatioin and add your DB_DATABASE name
-   Run `php artisan migrate:fresh --seed`, in your terminal, which wil run the migrations and seed the database with users and products. The user email, password and role will be printed to the terminal, for you to use when testing the application.
-   Now you can login with the user accounts above and see how user can only access certain parts of the application based on their roles.

## tech-test code files I've created and edited

-   Models: User model, Products model
-   \App\Role: classes to manage user roles and check user roles
-   Controllers: AuthToken for retrieving user api token, and ProductsController which is a REST Controller for CRUD operations on a product.
-   Middleware: CheckUserRole middleware to protect routes/controller functions based on user role.
-   Database: Products factory, and User factory
-   Migration: create_users added a roles field. create_products for storing products.
-   Resource/js/pages: Dashboard,Product,ProductsApproved,ProductsSubmit. These are the front end views for managing products.
-   Routes: web.php routes for rendering views and api.php for api access
-   Test: Feature tests for roles and api routes

## usage

-   login with different user accounts, and see that users can only perform certain actions with certain roles. The default role a user will receive when registering on the front end through the registration form is as a client.
