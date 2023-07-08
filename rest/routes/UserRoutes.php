<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once './services/UserServices.php';
require_once './dao/UserDao.class.php';

/**
 * @OA\Post(
 *     path="/register",
 *     tags={"User"},
 *     summary="Register a new user",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string",
 *                 ),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Success",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *             ),
 *         ),
 *     ),
 * )
 */
Flight::route('POST /register', function(){
    $name = Flight::request()->data['name'];
    $email = Flight::request()->data['email'];
    $password = Flight::request()->data['password'];
  
    $userServices = new UserServices(Flight::get('pdo'));
    $message = $userServices->registerUser($name, $email, $password);
  
    Flight::json(array('message' => $message), 200);
});

/**
 * @OA\Post(
 *     path="/login",
 *     tags={"User"},
 *     summary="User login",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string",
 *                 ),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Success",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="token",
 *                 type="string",
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Invalid credentials",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *             ),
 *         ),
 *     ),
 * )
 */
Flight::route('POST /login', function(){
    $login = Flight::request()->data->getData();
    $userDao = new UserDao(Flight::get('pdo'));
    $user = $userDao->getUserByEmail($login['email']);
    if (isset($user['id'])){
        $hashedPassword = $user['password'];
        if (password_verify($login['password'], $hashedPassword)) {
            unset($user['password']);
            $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
            Flight::json(['token' => $jwt]);
        } else {
            Flight::json(["message" => "Wrong password"], 404);
        }
    } else {
        Flight::json(["message" => "User doesn't exist"], 404);
    }
});

/**
 * @OA\Post(
 *     path="/logout",
 *     tags={"User"},
 *     summary="Logout the user",
 *     @OA\Response(
 *         response=200,
 *         description="Success",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *             ),
 *         ),
 *     ),
 * )
 */
Flight::route('POST /logout', function(){
    // Start the session
    session_start();

    // Clear the user session
    session_unset();
    session_destroy();

    // Send a success response
    Flight::json(array('message' => 'Logout successful'), 200);
});
?>
