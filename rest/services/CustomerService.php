<?php
require_once 'BaseService.php';
require_once __DIR__."/../dao/CustomersDao.class.php";

class StudentService extends BaseService{
    public function __construct(){
        parent::__construct(new CustomersDao);
    } 

    public function add($entity){
        return parent::add($entity);
    
    }
}
?>