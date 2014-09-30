<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="SlimSkeleton">
        <meta name="author" content="">
        <title>Slim Skeleton Sample</title>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    </head>
    <body style="">
        <div class="container">
            <h1>Slim Skeleton</h1>
            <div class="navbar navbar-default " role="navigation">
                <div class="container">
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="./">Home</a></li>
                            <li class='active'><a href="#">Documentation</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">
            <div>
                <h2>Documentation</h2>
                <p>
                    Slim Skeleton is a bootstrap application which built with <a href="http://www.slimframework.com/">Slim Framework</a> in MVC architecture and it provides a basic REST funcionality.
                </p>
            </div>
            <div>
                <h3>Structure</h3>
                <ul>
                    <li>
                        <strong>app</strong>: main directory of application.
                        <ul>
                            <li>
                                <strong>configuration</strong>
                                <ul>
                                    <li>
                                        <strong>database.php</strong> - settings of database connection.
                                    </li>
                                    <li>
                                        <strong>slim.php</strong> - settings of the Slim object.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>controllers</strong>
                                <ul>
                                    <li>
                                        <strong>BaseController</strong> - provides base functionality for controller classes.
                                    </li>
                                    <li>
                                        <strong>RestController</strong> - provides base rest functionality, sample rest controller.
                                    </li>
                                    <li>
                                        <strong>SiteController</strong> - managing the web sites.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>models</strong>
                                <ul>
                                    <li>
                                        <strong>BaseModel</strong> - provides base database operations for model classes.
                                    </li>
                                    <li>
                                        <strong>ContentModel</strong> - sample model class.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>views</strong>
                                <ul>
                                    <li>
                                        <strong>site</strong>
                                        <ul>
                                            <li>
                                                <strong>index.php</strong> - main page of the application.
                                            </li>
                                            <li>
                                                <strong>doc.php</strong> - documentation about the starter application.
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <strong>routes.php</strong> - routing configuration is located here.
                            </li>
                        </ul>
                    </li>
                    <li>
                        <strong>data</strong> - sample sql and json datas are placed.
                    </li>
                    <li>
                        <strong>vendor</strong>
                    </li>
                    <li>
                        <strong>.htaccess</strong>
                    </li>
                    <li>
                        <strong>composer.json</strong>
                    </li>
                    <li>
                        <strong>composer.lock</strong>
                    </li>
                    <li>
                        <strong>index.php</strong> - possibility to change the environment of application.
                    </li>
                </ul>
            </div>
            <br>
            <div>
                <h3>Installation</h3>
                <p>
                    Manually install Slim Skeleton by cloning this repo and run composer install.
                </p>
                <pre>
$ git clone https://github.com/botalaszlo/slim-skeleton.git
$ composer install
                </pre>
                <p>Do not forget set the permissions of the application's directory!</p>
            </div>
            <br>
            <div>
                <h3>Configuring</h3>
                <h4>Configuring the application environment</h4>
                <p>
                    In the root directory the <code>index.php</code>:<br>
                <pre>define('ENV', 'DEV');</pre>
                initalizing the environment. Here you have to modify the <code>ENV</code>-s value to other value if you want to switch of the development mode.
                </p>
            </div>
            <div>
                <h4>Configuring the database</h4>
                <p>
                    In the <code>app/configuration/database.php</code> you can set up the <code>database</code> settings.
                </p>
            </div>
            <div>
                <h4>Configuring the Slim object</h4>
                <p>
                    In the <code>app/configuration/slim.php</code> you can set up the <code>Slim</code> object.
                </p>
            </div>
            <br>
            <div>
                <h3>REST</h3>
                <div class="alert alert-info" role="alert">
                    Do not forget, these are just examples, you can modify!
                </div>
                <h4>Request header example</h4>
                <pre>
    Host: localhost
    Content-Type: application/json
    Cache-Control: no-cache
                </pre>
                <h4>Rest uri-s</h4>
                <table class="table">
                    <tr>
                        <th>
                            HTTP methods
                        </th>
                        <th>
                            URI
                        </th>
                        <th>
                            Description
                        </th>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>/api/contents</td>
                        <td>Listing the contents.</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>/api/contents/:id</td>
                        <td>Selecting a content by id number.</td>
                    </tr>
                    <tr>
                        <td>POST</td>
                        <td>/api/contents</td>
                        <td>Creating a contents.</td>
                    </tr>
                    <tr>
                        <td>PUT</td>
                        <td>/api/contents/:id</td>
                        <td>Modifing a content by id number.</td>
                    </tr>
                    <tr>
                        <td>DELETE</td>
                        <td>/api/contents/:id</td>
                        <td>Deleting a content by id</td>
                    </tr>              
                </table>
                <h5>Example data for post and put operations:</h5>
                <pre>
    {
        "data": 
        {
            "title":"Title Example",
            "content":"Title Content for the application."
        }
    }
                </pre>
                <br>
            </div>
    </body>
</html>

