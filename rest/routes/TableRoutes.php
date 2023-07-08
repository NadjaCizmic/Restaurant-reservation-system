<?php

require_once './services/TableService.php';

/**
 * @OA\Post(
 *     path="/bookings",
 *     tags={"Booking"},
 *     summary="Add a new booking",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="firstName",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="lastName",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="guests",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="phone",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="time",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="date",
 *                     type="string",
 *                     format="date",
 *                 ),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Success",
 *     ),
 * )
 */
Flight::route('POST /bookings', function(){
    $firstName = Flight::request()->data['firstName'];
    $lastName = Flight::request()->data['lastName'];
    $email = Flight::request()->data['email'];
    $guests = Flight::request()->data['guests'];
    $phone = Flight::request()->data['phone'];
    $time = Flight::request()->data['time'];
    $date = Flight::request()->data['date'];

    $bookingService = new TableService(Flight::get('pdo'));
    $booking = $bookingService->addBooking($firstName, $lastName, $email, $guests, $phone, $time, $date);

    Flight::json($booking);
});

/**
 * @OA\Get(
 *     path="/bookings",
 *     tags={"Booking"},
 *     summary="Get all bookings",
 *     @OA\Response(
 *         response=200,
 *         description="Success",
 *     ),
 * )
 */
Flight::route('GET /bookings', function(){
    $bookingService = new TableService(Flight::get('pdo'));
    $bookings = $bookingService->getAllBookings();

    Flight::json($bookings);
});

/**
 * @OA\Get(
 *     path="/bookings/{id}",
 *     tags={"Booking"},
 *     summary="Get a booking by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the booking",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Success",
 *     ),
 * )
 */
Flight::route('GET /bookings/@id', function($id){
    $bookingService = new TableService(Flight::get('pdo'));
    $booking = $bookingService->getBookingById($id);

    Flight::json($booking);
});

?>
