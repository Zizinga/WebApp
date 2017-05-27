# WebApp
The Zizinga web application based on Symfony 3(PHP Framework). Your go-to for humour and laughs to brighten your day.
The app is build with the following tech stack;

-Symfony 3 with Twig 
-Doctrine ORM (Can be configured for mysql, mongo or couch)
-Material Design for Bootstrap 
-RxJS
-Taiga.io for project management (https://tree.taiga.io/project/tonnyk-zizinga/kanban)

To setup, run through the following steps
-Install composer
-Install the symfony framework
-Run `composer install` and follow the promts for required paramater definition
-Run `php bin/console doctrine:generate:entities AppBundle` to create the entities 
-Run `php bin/console doctrine:schema:update --force` to setup the database tables
-Run `php bin/console doctrine:fixtures:load` to load default user data
-Run `php bin/console server:run` 