# Slim3 PHP micro framework boilerplate

This is a simple boilerplate for the [Slim3 PHP micro framework](http://www.slimframework.com/).

You can use it to quickly start a Slim3 project with the [Twig template engine](http://twig.sensiolabs.org/) and simple [Gulp](http://gulpjs.com/) tasks for your SCSS and javascript needs.

## Installation

First, install composer dependencies :

`composer install`

Then, ìnstall npm packages :

`npm install`

Perfect, now run the app :

`composer start`

That's it ! You can now access the app on [http://localhost:8080](http://localhost:8080), have fun !

_If you prefer, you can also access the app by pointing the virtual host document to the `public/` directory._

## Gulp tasks

The default gulp task will compile your SCSS and javascript.

The other tasks are the following :

SCSS :

`gulp sass`

Javascript :

`gulp js`

Watch all :

`gulp watch`
