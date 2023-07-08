<?php

require_once './dao/BaseDao.class.php';

class TablesDao extends BaseDao {
    public function __construct($pdo) {
        parent::__construct($pdo, 'bookings');
    }

    public function addBooking($firstName, $lastName, $email, $guests, $phone, $time, $date) {
        $booking = array(
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'guests' => $guests,
            'phone' => $phone,
            'time' => $time,
            'date' => $date
        );
        return $this->add($booking);
    }

    public function getAllBookings() {
        return $this->get_all();
    }

    public function getBookingById($id) {
        return $this->get_by_id($id);
    }

    public function updateBooking($booking, $id) {
        return $this->update($booking, $id);
    }

    public function deleteBooking($id) {
        $this->delete($id);
    }
}

?>