<?php
require_once __DIR__ . '/BaseDao.class.php';


class TablesDao extends BaseDao {

    public function __construct(){
        parent::__construct("table");
    }
}
?>