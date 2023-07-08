<?php
require_once './dao/BaseDao.class.php';

class FavouritePlaceDao extends BaseDao {
    public function __construct($pdo) {
        parent::__construct($pdo, 'favourite_places');
    }

    public function getAllFavouritePlaces() {
        return $this->get_all();
    }

    public function getFavouritePlaceById($id) {
        return $this->get_by_id($id);
    }

    public function addFavouritePlace($name, $location, $description) {
        $favouritePlace = array(
            'name' => $name,
            'location' => $location,
            'description' => $description
        );
        return $this->add($favouritePlace);
    }

    public function updateFavouritePlace($id, $name, $location, $description) {
        $favouritePlace = array(
            'name' => $name,
            'location' => $location,
            'description' => $description
        );
        return $this->update($favouritePlace, $id);
    }

    public function deleteFavouritePlace($id) {
        $this->delete($id);
    }
}

?>