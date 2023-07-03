<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Flight::route("GET /admin", function(){
    Flight::json(Flight::admin_service()->get_all());
 });
 
 Flight::route("GET /admin_by_id", function(){
    Flight::json(Flight::admin_service()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /admin/@id", function($id){
    Flight::json(Flight::admin_service()->get_by_id($id));
 });
 
 Flight::route("DELETE /admin/@id", function($id){
    Flight::admin_service()->delete($id);
    Flight::json(['message' => "Admin deleted successfully"]);
 });
 
 Flight::route("POST /admin", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "Admin added successfully",
                  'data' => Flight::admin_service()->add($request)
                 ]);
 });
 
 Flight::route("PUT /admin/@id", function($id){
    $admin = Flight::request()->data->getData();
    Flight::json(['message' => "Admin edit successfully",
                  'data' => Flight::admin_service()->update($admin, $id)
                 ]);
 });
 
 
?>