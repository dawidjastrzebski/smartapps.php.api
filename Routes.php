<?php

Route::set('about-us', function(){
    $controller = new AboutUs();
    $controller->Execute();
});

Route::set('contact-us', function(){
    echo "Contact us";
});

?>