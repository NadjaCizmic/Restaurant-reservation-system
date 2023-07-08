<?php

require_once './services/MenuService.php';

/**
 * @OA\Post(
 *     path="/menus",
 *     tags={"Menu"},
 *     summary="Add a new menu",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="description",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="price",
 *                     type="number",
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
Flight::route('POST /menus', function(){
    $name = Flight::request()->data['name'];
    $description = Flight::request()->data['description'];
    $price = Flight::request()->data['price'];

    $menuService = new MenuService(Flight::get('pdo'));
    $menu = $menuService->addMenu($name, $description, $price);

    Flight::json($menu);
});

/**
 * @OA\Get(
 *     path="/menus",
 *     tags={"Menu"},
 *     summary="Get all menus",
 *     @OA\Response(
 *         response=200,
 *         description="Success",
 *     ),
 * )
 */
Flight::route('GET /menus', function(){
    $menuService = new MenuService(Flight::get('pdo'));
    $menus = $menuService->getAllMenus();

    Flight::json($menus);
});

/**
 * @OA\Get(
 *     path="/menus/{id}",
 *     tags={"Menu"},
 *     summary="Get a menu by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the menu",
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
Flight::route('GET /menus/@id', function($id){
    $menuService = new MenuService(Flight::get('pdo'));
    $menu = $menuService->getMenuById($id);

    Flight::json($menu);
});

/**
 * @OA\Put(
 *     path="/menus/{id}",
 *     tags={"Menu"},
 *     summary="Update a menu",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the menu",
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
 *                     property="description",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="price",
 *                     type="number",
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
Flight::route('PUT /menus/@id', function($id){
    $menuService = new MenuService(Flight::get('pdo'));

    $menu = Flight::request()->data;
    $updatedMenu = $menuService->updateMenu($menu, $id);

    Flight::json($updatedMenu);
});

/**
 * @OA\Delete(
 *     path="/menus/{id}",
 *     tags={"Menu"},
 *     summary="Delete a menu",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the menu",
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
Flight::route('DELETE /menus/@id', function($id){
    $menuService = new MenuService(Flight::get('pdo'));
    $menuService->deleteMenu($id);

    Flight::json(array('message' => 'Menu deleted successfully'));
});

?>
