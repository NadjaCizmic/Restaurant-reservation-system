<?php
require_once 'BaseService.php';
require_once __DIR__."/../dao/ReservationsDao.class.php";

class ReservationService extends BaseService{
    public function __construct(){
        parent::__construct(new ReservationsDao);
    } 

}
?>