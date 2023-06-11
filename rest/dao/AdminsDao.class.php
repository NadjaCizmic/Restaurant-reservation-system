<?php
require_once __DIR__ . '/BaseDao.class.php';


class AdminsDao extends BaseDao {

    public function __construct(){
        parent::__construct("admin");
    }
}
?>