<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

require "../vendor/autoload.php";
require_once "dao/CustomersDao.class.php";
Flight::register("customersDao", "CustomersDao");

Flight::route("/", function(){
    echo "Hello world";
});

Flight::route("GET /customers", function(){
    Flight::json(Flight::customersDao()->get_all());
});

Flight::route("GET /customers/@id", function($id){
    Flight::json(Flight::customersDao()->get_by_id($id));
});

Flight::route("DELETE /customers/@id", function($id){
    //echo "Hello from /students";
    //$customer_dao = new CustomersDao();
    //$results = $customer_dao->delete($id);
    Flight::customersDao()->delete($id);
    Flight::json(["message" => "Customer deleted"]);
});

Flight::route("POST /customer", function(){
    //echo "Hello from /customers";
    //$customer_dao = new CustomersDao();
    //$first_name = '';
    //$last_name = '';
    //$results = $customer_dao->add($first_name, $last_name);
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "Customer added successfully",
                 'data' => Flight::customersDao()->add($request)
                ]);
});

Flight::route("PUT /customer/@id", function($id){
    //echo "Hello from /customers";
    //$customer_dao = new CustomersDao();
    //$results = $customer_dao->update($first_name, $last_name);
    $customer = Flight::request()->data->getData();
    Flight::json(['message' => "Customer edit successfully",
                 'data' => Flight::customersDao()->update($customer, $id)
                ]);
});

Flight::start();
?>
