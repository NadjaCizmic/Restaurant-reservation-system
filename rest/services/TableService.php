<?php

require_once './dao/TablesDao.class.php';

class TableService {
    private $bookingDao;

    public function __construct($pdo) {
        $this->bookingDao = new TablesDao($pdo);
    }

    public function addBooking($firstName, $lastName, $email, $guests, $phone, $time, $date) {
        return $this->bookingDao->addBooking($firstName, $lastName, $email, $guests, $phone, $time, $date);
    }

    public function getAllBookings() {
        return $this->bookingDao->getAllBookings();
    }

    public function getBookingById($id) {
        return $this->bookingDao->getBookingById($id);
    }

    public function updateBooking($booking, $id) {
        return $this->bookingDao->updateBooking($booking, $id);
    }

    public function deleteBooking($id) {
        $this->bookingDao->deleteBooking($id);
    }
}

?>
