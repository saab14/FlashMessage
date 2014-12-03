[![Build Status](https://scrutinizer-ci.com/g/saab14/FlashMessage/badges/build.png?b=master)](https://scrutinizer-ci.com/g/saab14/FlashMessage/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/saab14/FlashMessage/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/saab14/FlashMessage/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/saab14/FlashMessage/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/saab14/FlashMessage/?branch=master)

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
    $app->theme->setTitle("Me");
    $content = $app->fileContent->get('me.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline
    ]);
    $app->views->addString('ruben-gris.png', 'banner');
    // Add comments section
    $di->comments->addToView('main-footer');
    });

Then You can use Flash with the CDatabase library by including that library in the new controller.

    // Include database support
    $di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/database_sqlite.php');
    $db->connect();
    return $db;
    });
    
Create a route for the Flash

    $app->router->add('flashmessage', function() use ($app) { 
    $app->theme->setTitle("Testsida för flashmeddelanden"); 
    $flash = $app->flashMessage; 
    $flash->infoMessage("Info: This is an info message!"); 
    $flash->errorMessage("Error: This is an error message!"); 
    $flash->warningMessage("Warning: This is a warning message!"); 
    $flash->successMessage("Success: This is a success message!"); 
    $flash->retrieveMessages(); 
    $app->views->addString($flash->messagesHtml(), 'flash'); 
    }); 
