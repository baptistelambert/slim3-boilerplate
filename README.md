# Slim3 PHP micro framework boilerplate

This is a simple boilerplate for the [Slim3 PHP micro framework](http://www.slimframework.com/).

You can use it to quickly start a Slim3 project with the [Twig template engine](http://twig.sensiolabs.org/), the [Doctrine ORM](http://www.doctrine-project.org/projects/orm.html) and some simple [Gulp](http://gulpjs.com/) tasks for your SCSS and javascript needs.

## Installation

First, install composer dependencies :

`composer install`

Then, ìnstall npm packages :

`npm install`

Perfect, now run the app :

`composer start`

That's it ! You can now access the app on [http://localhost:8080](http://localhost:8080), have fun !

_If you prefer, you can also access the app by pointing the virtual host document to the `public/` directory._

## Doctrine

_Before executing any commands, be careful of the light logic already present within this boilerplate in `src/Entity/`, it is destined to serve only as an example and can be deleted._

First, set your database parameters in the `app/settings.php` file.

Then you can define your entities in the `src/Entity`.

You can access Doctrine by executing the following command :

`php vendor/bin/doctrine`

If you want to generate your database tables based on your entities, run the following command :

`php vendor/bin/doctrine orm:schema-tool:create`

If you want to update your database tables based on your entities, run the following command :

`php vendor/bin/doctrine orm:schema-tool:update`

_More informations about using the Doctrine ORM [here](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/)._

## Gulp tasks

The default gulp task will compile your SCSS and javascript.

The other tasks are the following :

SCSS :

`gulp sass`

Javascript :

`gulp js`

Watch all :

`gulp watch`
