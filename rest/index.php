<?php
require "../vendor/autoload.php";
require "services/CustomerService.php";
require "services/CourseService.php";

Flight::register('customer_service', "CustomerService");
Flight::register('course_service', "CourseService");

require_once 'routes/CustomerRoutes.php';
require_once 'routes/CourseRoutes.php';

Flight::start();
?>
