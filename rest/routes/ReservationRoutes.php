<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Flight::route("GET /reservation", function(){
    Flight::json(Flight::reservationsDao()->get_all());
 });
 
 Flight::route("GET /reservation_by_id", function(){
    Flight::json(Flight::reservationsDao()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /reservation/@id", function($id){
    Flight::json(Flight::reservationsDao()->get_by_id($id));
 });
 
 Flight::route("DELETE /reservation/@id", function($id){
    Flight::reservationsDao()->delete($id);
    Flight::json(['message' => "Reservation deleted successfully"]);
 });
 
 Flight::route("POST /reservation", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "Reservation added successfully",
                  'data' => Flight::reservationsDao()->add($request)
                 ]);
 });
 
 Flight::route("PUT /reservation/@id", function($id){
    $reservation = Flight::request()->data->getData();
    Flight::json(['message' => "Reservation edit successfully",
                  'data' => Flight::reservationsDao()->update($reservation, $id)
                 ]);
 });
 
 
?>