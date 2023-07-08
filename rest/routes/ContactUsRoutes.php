<?php

require_once './services/ContactUsServices.php';

/**
 * @OA\Post(
 *     path="/send_message",
 *     tags={"Contact"},
 *     summary="Send a message",
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
 *                     property="subject",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="message",
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
 *     @OA\Response(
 *         response=500,
 *         description="Failed to send message",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *             ),
 *         ),
 *     ),
 * )
 */
Flight::route('POST /send_message', function(){
    $name = Flight::request()->data['name'];
    $email = Flight::request()->data['email'];
    $subject = Flight::request()->data['subject'];
    $message = Flight::request()->data['message'];

    $contactServices = new ContactUsServices(Flight::get('pdo'));
    $result = $contactServices->sendMessage($name, $email, $subject, $message);

    if ($result === true) {
        Flight::json(array('message' => 'Message sent successfully'), 200);
    } else {
        Flight::json(array('message' => 'Failed to send message'), 500);
    }
});

?>
