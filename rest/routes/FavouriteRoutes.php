<?php
require_once './services/FavouritePlaceService.php';

/**
 * @OA\Get(
 *     path="/favourite-places",
 *     tags={"Favourite Places"},
 *     summary="Get all favourite places",
 *     @OA\Response(
 *         response=200,
 *         description="Success",
 *     ),
 * )
 */

Flight::route('GET /favourite-places', function(){
    $favouritePlaceService = new FavouritePlaceService(Flight::get('pdo'));
    $favouritePlaces = $favouritePlaceService->getAllFavouritePlaces();

    Flight::json($favouritePlaces);
});

/**
 * @OA\Get(
 *     path="/favourite-places/{id}",
 *     tags={"Favourite Places"},
 *     summary="Get a favourite place by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the favourite place",
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

Flight::route('GET /favourite-places/@id', function($id){
    $favouritePlaceService = new FavouritePlaceService(Flight::get('pdo'));
    $favouritePlace = $favouritePlaceService->getFavouritePlaceById($id);

    Flight::json($favouritePlace);
});

/**
 * @OA\Post(
 *     path="/favourite-places",
 *     tags={"Favourite Places"},
 *     summary="Add a new favourite place",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="location",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="description",
 *                     type="string",
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
Flight::route('POST /favourite-places', function(){
    $name = Flight::request()->data['name'];
    $location = Flight::request()->data['location'];
    $description = Flight::request()->data['description'];

    $favouritePlaceService = new FavouritePlaceService(Flight::get('pdo'));
    $favouritePlace = $favouritePlaceService->addFavouritePlace($name, $location, $description);

    Flight::json($favouritePlace);
});

/**
 * @OA\Put(
 *     path="/favourite-places/{id}",
 *     tags={"Favourite Places"},
 *     summary="Update a favourite place",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the favourite place",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
 *         ),
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="location",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="description",
 *                     type="string",
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
Flight::route('PUT /favourite-places/@id', function($id){
    $name = Flight::request()->data['name'];
    $location = Flight::request()->data['location'];
    $description = Flight::request()->data['description'];

    $favouritePlaceService = new FavouritePlaceService(Flight::get('pdo'));
    $favouritePlace = $favouritePlaceService->updateFavouritePlace($id, $name, $location, $description);

    Flight::json($favouritePlace);
});


/**
 * @OA\Delete(
 *     path="/favourite-places/{id}",
 *     tags={"Favourite Places"},
 *     summary="Delete a favourite place",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the favourite place",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64",
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
Flight::route('DELETE /favourite-places/@id', function($id){
    $favouritePlaceService = new FavouritePlaceService(Flight::get('pdo'));
    $favouritePlaceService->deleteFavouritePlace($id);

    Flight::json(array('message' => 'Favourite place deleted'));
});
?>