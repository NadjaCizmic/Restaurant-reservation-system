<?php
require "vendor/autoload.php";

Flight::route("/", function(){
    echo "Hello world";
});

Flight::route("GET /test", function(){
    echo "Hello from test";
});

Flight::start();
?>
