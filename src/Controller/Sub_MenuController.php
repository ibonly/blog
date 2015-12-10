<?php

namespace Ibonly\Blog;

use Ibonly\Blog\Sub_Menu;

class Sub_MenuController
{
    protected $menu;

    function __construct() {
        $this->menu = new Sub_Menu();
    }

    /**
     * Insert into sub_menu table
     *
     * @param  $name
     * @param  $description
     *
     * @return bool
     */
    public function insertMenu ($name, $description)
    {
        $this->menu->id = NULL;
        $this->menu->menu_id = $_POST['menu_id'];
        $this->menu->name = $_POST['name'];
        $this->menu->description = $_POST['description'];
        $this->menu->date_created = date('Y-m-d H:i:s');

        $save = $this->menu->save();

        if ($save) {
            return "Done";
        } else {
            return "Error";
        }
    }
}
