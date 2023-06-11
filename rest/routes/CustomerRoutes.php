<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Flight::route("GET /customers", function(){
    Flight::json(Flight::customersDao()->get_all());
 });
 
 Flight::route("GET /customer_by_id", function(){
    Flight::json(Flight::customersDao()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /customers/@id", function($id){
    Flight::json(Flight::customersDao()->get_by_id($id));
 });
 
 Flight::route("DELETE /customers/@id", function($id){
    Flight::customersDao()->delete($id);
    Flight::json(['message' => "Customer deleted successfully"]);
 });
 
 Flight::route("POST /customer", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "Student added successfully",
                  'data' => Flight::customersDao()->add($request)
                 ]);
 });
 
 Flight::route("PUT /customer/@id", function($id){
    $student = Flight::request()->data->getData();
    Flight::json(['message' => "Customeer edit successfully",
                  'data' => Flight::customersDao()->update($customer, $id)
                 ]);
 });
 
 Flight::route("GET /customers/@name", function($name){
    echo "Hello from /customers route with name= ".$name;
 });
 
?>