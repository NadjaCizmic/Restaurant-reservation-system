<?php
require_once './dao/FavouritePlaceDao.php';

class FavouritePlaceService {
    private $favouritePlaceDao;

    public function __construct($pdo) {
        $this->favouritePlaceDao = new FavouritePlaceDao($pdo);
    }

    public function getAllFavouritePlaces() {
        return $this->favouritePlaceDao->getAllFavouritePlaces();
    }

    public function getFavouritePlaceById($id) {
        return $this->favouritePlaceDao->getFavouritePlaceById($id);
    }

    public function addFavouritePlace($name, $location, $description) {
        return $this->favouritePlaceDao->addFavouritePlace($name, $location, $description);
    }

    public function updateFavouritePlace($id, $name, $location, $description) {
        return $this->favouritePlaceDao->updateFavouritePlace($id, $name, $location, $description);
    }

    public function deleteFavouritePlace($id) {
        $this->favouritePlaceDao->deleteFavouritePlace($id);
    }
}
?>