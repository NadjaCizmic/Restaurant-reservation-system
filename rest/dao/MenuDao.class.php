<?php

require_once './dao/BaseDao.class.php';

class MenuDao extends BaseDao {
    public function __construct($pdo) {
        parent::__construct($pdo, 'menus');
    }

    public function addMenu($name, $description, $price) {
        $menu = array(
            'name' => $name,
            'description' => $description,
            'price' => $price
        );
        return $this->add($menu);
    }

    public function getAllMenus() {
        return $this->get_all();
    }
    public function getMenuById($id) {
        return $this->get_by_id($id);
    }

    public function updateMenu($menu, $id) {
        return $this->update($menu, $id);
    }

    public function deleteMenu($id) {
        $this->delete($id);
    }
}

?>
