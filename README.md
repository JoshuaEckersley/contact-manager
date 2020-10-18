## Installation

To get this project running in your environment:

1. Clone the repository [https://github.com/JoshuaEckersley/contact-manager.git].
2. Run "composer install".
3. Copy the .env.example and rename as .env.
4. Update .env with your database connection details. (Note this app has only been tested on a mysql database).
5. Run "php artisan key:generate".
6. Run "php artisan migrate:fresh --seed".
7. Run "php artisan serve".

And you're good to go. Browse to the url the php artisan serve command output to view the application.

For ease of use, the seeders have configured users user1, user2, user3, and user4 with a password of "password" that can be used for login (all emails are @example.com).
