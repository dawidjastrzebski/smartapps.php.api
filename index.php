<!--  mklink /D smartapps.ui C:\GitReposDJ\smartapps.ui\ -->
<?php

/*
 * By including routes/Routes.php we get access to the $Routes
 * array containing all of the valid routes for our app.
*/
spl_autoload_register(function ($class_name) {
    if (file_exists('./classes/'.$class_name.'.php')){
        //echo "Autolaod classes";
        include './classes/'.$class_name.'.php';
    } else if (file_exists('./Controllers/'.$class_name.'.php')){
        //echo "Autoload Controllers";
        include './Controllers/'.$class_name.'.php';
    }
});

require_once('Routes.php');

?>