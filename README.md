# Symfony-angular-app-with-docker

Some steps to run this project:

<code>docker-compose up --build</code>

For symfony part you need to add the dependinces:

Run <code>composer install</code> in php container
  
Now you have angular: http://localhost:4200/ and symfony http://localhost

Run this <code> php bin/console doctrine:database:create</code> and <code>php bin/console doctrine:migrations:migrate</code> in php container to generate the database and the tables

To create an admin user  <code>http://localhost/api/generate_data</code>

Then you will have an admin account with username: administrator and password: 123456

To login <code>http://localhost/login?username=administrator&password=123456</code>
