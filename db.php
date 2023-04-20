<?php

    require_once("rest/dao/CustomersDao.class.php");
    $customer_dao = new CustomersDao();

    $results = $customer_dao->get_all();
    print_r($results);
    /*$servername = "localhost";
    $username="root";
    $password="1234";
    $schema="web-project";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        $stmt = $conn->prepare("SELECT * FROM customers");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }*/
?>
