Use in Anax

Setup the controller

First let's create a basic ANAX Controller. We include the config and create a start route

<?php 
/**
* This is a Anax pagecontroller.
*
*/
Get environment & autoloader. require DIR.'/config_with_app.php';

$app->router->add('', function() use ($app, $di) {
$app->theme->setTitle("Yuml test");
$app->views->add('me/page', [
    'content' => 'hi',
    'byline' => null
  ]);
});
    $app->router->handle();
    $app->theme->render();
Then You can use Flash with the CDatabase library by including that library in the new controller.

//Include database support
$di->setShared('db', function() {
$db = new \Mos\Database\CDatabaseBasic();
$db->setOptions(require ANAX_APP_PATH . 'config/database_sqlite.php');
$db->connect();
return $db;
});
Now you can include the Flash library. If you install with composer the autoloader will automatically find the class files.

//Include support for Flash
$di->setShared('flash', function() {
$flash = new \saab\CFlashMessage\CFlashMessage();
return $flash;
});
Create a route for the Flash

$app->router->add('flashmessage', function() use ($app) {
$app->theme->setTitle("Flash test");
$app->flash->message('info', 'This is a info message');
$app->flash->message('success', 'This is a success message');
$app->flash->message('warning', 'This is a warning message');
$app->flash->message('error', 'This is a error message');
$app->theme->setVariable('title', "Flash test");
$app->views->add('me/page', [ 
    'content' => $app->flash->getMessages(),
    ]); 
});