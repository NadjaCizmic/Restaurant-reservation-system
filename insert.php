<?php

    require_once("rest/dao/CustomersDao.class.php");
    $customer_dao = new CustomersDao();
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $results = $customer_dao->add($first_name, $last_name);
    print_r($results)
    /*$servername = "127.0.0.1";
    $username="root";
    $password="1234";
    $schema="web-project";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        $first_name = $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        $stmt = $conn->prepare("INSERT INTO customers (first_name, last_name) VALUES ('$first_name', '$last_name')");
        $result = $stmt->execute();
        print_r($result);
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }*/
?>
