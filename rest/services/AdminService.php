<?php
require_once 'BaseService.php';
require_once __DIR__."/../dao/AdminsDao.class.php";

class AdminService extends BaseService{
    public function __construct(){
        parent::__construct(new AdminsDao);
    } 
}
?>