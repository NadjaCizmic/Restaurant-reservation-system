<?php
require_once 'BaseService.php';
require_once __DIR__."/../dao/TablesDao.class.php";

class TableService extends BaseService{
    public function __construct(){
        parent::__construct(new TablesDao);
    } 

    public function add($entity){
        return parent::add($entity);
    
    }
}
?>