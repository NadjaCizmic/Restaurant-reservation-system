<?php

require_once("rest/dao/CustomersDao.class.php");
$customer_dao = new CustomersDao();

$type = $_REQUEST['type'];

switch ($type) {
    case 'add':
        $first_name = $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        $results = $customer_dao->add($first_name, $last_name);
        print_r($results);
        break;

    case 'delete':
        $id = $_REQUEST['id'];
        $customer_dao->delete($id);
        break;
    case 'update':
        $first_name = $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        $id = $_REQUEST['id'];
        $customer_dao->update($first_name, $last_name, $id);
        break;

    case 'get':
    default:
        $results = $customer_dao->get_all();
        print_r($results);
        break;        
}
?>
