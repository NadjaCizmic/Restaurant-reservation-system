<?php
require_once __DIR__ . '/BaseDao.class.php';


class ReservationsDao extends BaseDao {

    public function __construct(){
        parent::__construct("reservation");
    }
}
?>