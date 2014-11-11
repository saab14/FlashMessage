<?php 
/**
 * This is a Anax pagecontroller to test CStatusMessage module.
 * Move this file and status_message.css to /webroot to test the module.
 * Alternatively you can use the second require below from the
 * vendor dir and while it will not look right it will work.
 *
 */
// Get environment & autoloader and the $app-object.
// Use this row if you move the text files
// to /webroot.
require __DIR__.'/config_with_app.php'; 
// Use this path if you want to try the module from the vendor dir
//require '../../../../../webroot/config_with_app.php'; 
$app->theme->addStylesheet('flash.css');
$status = new saab\CFlashMessage\CFlashMessage();
$status->infoMessage("Info: #1");
$status->errorMessage("Error: #2");
$status->warningMessage("Warning: #3");
$status->successMessage("Success: #4");
$status->retrieveMessages();
// Prepare the page content
$app->theme->setVariable('title', "Test page for CFlashMessage")
           ->setVariable('main', "
    <h1>Test page for CFlashMessage</h1>
    <p>If four different messages how up below, it works!</p>
" . $status->messagesHtml());
// Render the response using theme engine.
$app->theme->render();