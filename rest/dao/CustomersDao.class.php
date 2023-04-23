<?php
require_once __DIR__ . '/BaseDao.class.php';


class CustomersDao extends BaseDao {

    public function __construct(){
        parent::__construct("customers");
    }
}
?>