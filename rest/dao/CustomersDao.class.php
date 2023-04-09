<?php
class CustomersDao{
    private $conn;

    /**
    * Class constructor used to establish connection to db
    */
        public function __construct(){
            try {
            $servername = "127.0.0.1";
            $username="root";
            $password="1234";
            $schema="web-project";
            $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            }
        }

        /**
        * Method used to get all customers from database
        */
        public function get_all(){
            $stmt = $this->conn->prepare("SELECT * FROM customers");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        /**
        * Method used to get add customer to database
        */
        public function add($first_name, $last_name){
            $stmt = $this->conn->prepare("INSERT INTO customers (first_name, last_name) VALUES ('$first_name', '$last_name')");
            $result = $stmt->execute();
        }
        /**
        * Method used to update customer to database
        */
        public function update($first_name, $last_name, $id){
            $stmt = $this->conn->prepare("UPDATE customers SET first_name='$first_name', last_name='$last_name' WHERE id=$id");
            $stmt->execute();
        }

    /**
        * Method used to delete customer from database
        */
        public function delete($id){
            $stmt = $this->conn->prepare("DELETE FROM customers WHERE id=:id");
            $stmt->bindParam(':id', $id); 
            $stmt->execute();
        }
}

?>