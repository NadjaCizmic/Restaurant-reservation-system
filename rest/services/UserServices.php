<?php

require_once './dao/UserDao.class.php';
use Firebase\JWT\JWT;
class UserServices {
    private $userDao;

    public function __construct($pdo) {
        $this->userDao = new UserDao($pdo);
    }

    public function registerUser($name, $email, $password) {
        return $this->userDao->registerUser($name, $email, $password);
    }

    public function loginUser($email, $password) {
        $user = $this->userDao->getUserByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            throw new Exception("Invalid email or password.");
        }

        // Generate JWT token
        $jwt_secret = Flight::get('jwt_secret');
        $payload = array(
            "user_id" => $user['id'],
            "email" => $user['email']
        );
        $jwt = JWT::encode($payload, $jwt_secret, 'HS256');

        return $jwt;
    }
}

?>
