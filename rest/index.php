<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

// Check the request method
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit;
}

require "../vendor/autoload.php";
require "services/TableService.php";
require "services/UserServices.php";
require "services/ContactUsServices.php";
require "services/MenuService.php";
require "services/FavouritePlaceService.php";

Flight::register('table_service', "TableService");
Flight::register('user_services', "UserServices");
Flight::register('contact_us_services', "ContactUsServices");
Flight::register('menu_services', "MenuService");
Flight::register('reservation_services', "FavouritePlaceService");

require_once 'routes/UserRoutes.php';
require_once 'routes/TableRoutes.php';
require_once 'routes/ContactUsRoutes.php';
require_once 'routes/MenuRoutes.php';
require_once 'routes/FavouriteRoutes.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// middleware method for login
Flight::route('/*', function(){
    //perform JWT decode
    $path = Flight::request()->url;
    if ($path == '/login' || $path == '/docs.json') return TRUE; // exclude login route from middleware
  
    $headers = getallheaders();
    if (!isset($headers['Authorization']) || empty($headers['Authorization'])) {
        Flight::json(["message" => "Authorization is missing"], 403);
        return FALSE;
    } else {
        try {
            $decoded = (array) JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
            Flight::set('user', $decoded);
            return TRUE;
        } catch (\Exception $e) {
            Flight::json(["message" => "Authorization token is not valid"], 403);
            return FALSE;
        }
    }
});

/* REST API documentation endpoint */
Flight::route('GET /docs.json', function(){
    $openapi = \OpenApi\scan('routes');
    header('Content-Type: application/json');
    echo $openapi->toJson();
  });

Flight::start();
?>
