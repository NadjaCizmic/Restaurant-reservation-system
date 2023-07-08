<?php

require_once './dao/MenuDao.class.php';

class MenuService {
    private $menuDao;

    public function __construct($pdo) {
        $this->menuDao = new MenuDao($pdo);
    }

    public function addMenu($name, $description, $price) {
        return $this->menuDao->addMenu($name, $description, $price);
    }

    public function getAllMenus() {
        return $this->menuDao->getAllMenus();
    }

    public function getMenuById($id) {
        return $this->menuDao->getMenuById($id);
    }

    public function updateMenu($menu, $id) {
        return $this->menuDao->updateMenu($menu, $id);
    }

    public function deleteMenu($id) {
        $this->menuDao->deleteMenu($id);
    }
}

?>