Slim MVC Skeleton
=============

Slim MVC Skeleton is a starter application which built in MVC architecture and it provides a basic REST functionality. It is based on the [Slim framework](http://www.slimframework.com/).

##Installation

Manually install Slim MVC Skeleton by **cloning this repo** and run `composer install`.
```
$ git clone https://github.com/botalaszlo/slim-skeleton.git
$ composer install
```
Do not forget set the permissions of the application's directory, if needs!


##Structure

* **app**: main directory of application.
  * **configs**
    * **database.php** - settings of database connection.
    * **slim.php** - settings of the Slim object.
  * **controllers**
    * **RestController** - provides base rest functionality, sample rest controller.
  * **lib**
    * **AbstractController** - provides base functionality for controller classes.
    * **AbstractModel** - provides base database operations for model classes.
    * **ModelService** - contains database functions.
  * **models**
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

In the `app/configs/database.php` you can set up the **database settings**.

###Configuring the Slim object

In the `app/configs/slim.php` you can set up the **Slim object**.

##Example

###Rest
Do not forget, these are just examples, you can modify!
Request header example
```
Host: localhost
Content-Type: application/json
Cache-Control: no-cache
```
####Rest uri-s
| HTTP methods |	URI |	Description |
|--------------|-----|-------------|
| GET | /api/contents |	Listing the contents. |
| GET |	/api/contents/:id |	Selecting a content by id number.|
| POST |	/api/contents |	Creating a contents. | 
| PUT |	/api/contents/:id |	Modifing a content by id number. |
| DELETE |	/api/contents/:id |	Deleting a content by id |

####Example data for post and put operations:
```
{
   "data": 
     {
       "title":"Title Example",
       "content":"Title Content for the application."
     }
}
```
