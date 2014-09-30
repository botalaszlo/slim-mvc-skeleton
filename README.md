Slim MVC Skeleton
=============

Slim MVC Skeleton is a starter application which built in MVC architecture and it provides a basic REST functionality. It is based on the [Slim framework](http://www.slimframework.com/).

##Installation

Manually install Slim MVC Skeleton by **cloning this repo** and run `composer install`.
```
$ git clone https://github.com/botalaszlo/slim-skeleton.git
$ composer install
```
Do not forget set the permissions of the application's directory!


##Structure

* **app**: main directory of application.
  * **configuration**
    * **database.php** - settings of database connection.
    * **slim.php** - settings of the Slim object.
  * **controllers**
    * **BaseController** - provides base functionality for controller classes.
    * **RestController** - provides base rest functionality, sample rest controller.
    * **SiteController** - managing the web sites.
  * **models**
    * **BaseModel** - provides base database operations for model classes.
    * **ContentModel** - sample model class.
  * **views**
    * **site** - it contains the HTML templates.
      * **index.php** - main page of the application.
      * **doc.php** - documentation about the starter application.
  * **routes.php** - routing configuration is located here.
* **data** - sample sql and json datas are placed.
* **.htaccess**
* **composer.json**
* **composer.lock**
* **index.php** - possibility to change the environment of application.


##Configuring

###Configuring the application environment

In the root directory the `index.php`:
`define('ENV', 'DEV');`
initalizing the environment. Here you have to modify the `ENV`-s value to other value if you want to switch of the development mode.

###Configuring the database

In the `app/configuration/database.php` you can set up the **database settings**.

###Configuring the Slim object

In the `app/configuration/slim.php` you can set up the **Slim object**.
