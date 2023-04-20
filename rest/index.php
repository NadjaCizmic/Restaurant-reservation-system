<?php
require "../vendor/autoload.php";
require "dao/CustomersDao.class.php";

Flight::route("/", function(){
    echo "Hello world";
});

Flight::route("GET /customers", function(){
    //echo "Hello from /students";
    $customer_dao = new CustomersDao();
    $results = $customer_dao->get_all();
    Flight::json($results);
});

Flight::route("GET /customers/@id", function($id){
    //echo "Hello from /students";
    $customer_dao = new CustomersDao();
    $results = $customer_dao->get_by_id($id);
    Flight::json($results);
});

Flight::route("DELETE /customers/@id", function($id){
    //echo "Hello from /students";
    $customer_dao = new CustomersDao();
    $results = $customer_dao->delete($id);
    Flight::json(["message" => "Customer deleted"]);
});

Flight::route("POST /customer", function(){
    //echo "Hello from /customers";
    $customer_dao = new CustomersDao();
    $first_name = '';
    $last_name = '';
    $results = $customer_dao->add($first_name, $last_name);
    Flight::json(["message" => "Customer added"]);
});

Flight::start();
?>
