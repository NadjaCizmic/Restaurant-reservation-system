<?php
require "../vendor/autoload.php";
require "services/CustomerService.php";
require "services/ReservationService.php";
require "services/AdminService.php";
require "services/TableService.php";
require "services/EmployeeService.php";

Flight::register('customer_service', "CustomerService");
Flight::register('reservation_service', "ReservationService");
Flight::register('admin_service', "AdminService");
Flight::register('table_service', "TableService");
Flight::register('employee_service', "EmployeeService");

require_once 'routes/CustomerRoutes.php';
require_once 'routes/ReservationRoutes.php';
require_once 'routes/EmployeeRoutes.php';

Flight::start();
?>
