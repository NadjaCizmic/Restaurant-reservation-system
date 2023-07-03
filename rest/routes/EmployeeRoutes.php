<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Flight::route("GET /employees", function(){
    Flight::json(Flight::employee_service()->get_all());
 });
 
 Flight::route("GET /employee_by_id", function(){
    Flight::json(Flight::employee_service()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /employees/@id", function($id){
    Flight::json(Flight::employee_service()->get_by_id($id));
 });
 
 Flight::route("DELETE /employees/@id", function($id){
    Flight::employee_service()->delete($id);
    Flight::json(['message' => "Employee deleted successfully"]);
 });
 
 Flight::route("POST /employees", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "Employee added successfully",
                  'data' => Flight::employee_service()->add($request)
                 ]);
 });
 
 Flight::route("PUT /employees/@id", function($id){
    $employee = Flight::request()->data->getData();
    Flight::json(['message' => "Employee edit successfully",
                  'data' => Flight::employee_service()->update($employee, $id)
                 ]);
 });
 
 
?>