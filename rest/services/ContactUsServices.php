<?php

require_once './dao/ContactUsDao.class.php';

class ContactUsServices {
    private $contactDao;

    public function __construct($pdo) {
        $this->contactDao = new ContactUsDao($pdo);
    }

    public function sendMessage($name, $email, $subject, $message) {
        $result = $this->contactDao->sendMessage($name, $email, $subject, $message);
        return $result;
    }
}

?>