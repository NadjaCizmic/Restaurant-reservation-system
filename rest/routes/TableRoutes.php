<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Flight::route("GET /table", function(){
    Flight::json(Flight::tablesDao()->get_all());
 });
 
 Flight::route("GET /table_by_id", function(){
    Flight::json(Flight::tablesDao()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /table/@id", function($id){
    Flight::json(Flight::tablesDao()->get_by_id($id));
 });
 
 Flight::route("DELETE /table/@id", function($id){
    Flight::tablesDao()->delete($id);
    Flight::json(['message' => "Table deleted successfully"]);
 });
 
 Flight::route("POST /table", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "Table added successfully",
                  'data' => Flight::tablesDao()->add($request)
                 ]);
 });
 
 Flight::route("PUT /table/@id", function($id){
    $table = Flight::request()->data->getData();
    Flight::json(['message' => "Table edit successfully",
                  'data' => Flight::tablesDao()->update($table, $id)
                 ]);
 });
 
 
?>