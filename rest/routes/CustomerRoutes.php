<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Flight::route("GET /customers", function(){
    Flight::json(Flight::customer_service()->get_all());
 });
 
 Flight::route("GET /customer_by_id", function(){
    Flight::json(Flight::customer_service()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /customers/@id", function($id){
    Flight::json(Flight::customer_service()->get_by_id($id));
 });
 
 Flight::route("DELETE /customers/@id", function($id){
    Flight::customer_service()->delete($id);
    Flight::json(['message' => "Customer deleted successfully"]);
 });
 
 Flight::route("POST /customer", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "Customer added successfully",
                  'data' => Flight::customer_service()->add($request)
                 ]);
 });
 
 Flight::route("PUT /customer/@id", function($id){
    $customer = Flight::request()->data->getData();
    Flight::json(['message' => "Customeer edit successfully",
                  'data' => Flight::customer_service()->update($customer, $id)
                 ]);
 });
 
 Flight::route("GET /customers/@name", function($name){
    echo "Hello from /customers route with name= ".$name;
 });
 
?>