<?php
require_once __DIR__ . '/BaseDao.class.php';


class EmployeesDao extends BaseDao {

    public function __construct(){
        parent::__construct("employees");
    }
}
?>