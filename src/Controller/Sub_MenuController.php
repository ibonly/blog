<?php

namespace Ibonly\Blog;

use Ibonly\Blog\Blog_Sub_Menu;
use Ibonly\Blog\Controller;

class Sub_MenuController extends Controller
{
    protected $menu;

    function __construct() {
        $this->menu = new Blog_Sub_Menu();
    }

    /**
     * Insert into sub_menu table
     *
     * @param  $name
     * @param  $description
     *
     * @return bool
     */
    public function insertSubMenu ($menu_id, $name, $description)
    {
        $this->menu->id = NULL;
        $this->menu->menu_id = $menu_id;
        $this->menu->name = $name;
        $this->menu->description = $description;
        $this->menu->date_created = date('Y-m-d H:i:s');

        $save = $this->menu->save();

        if ($save) {
            return "Done";
        } else {
            return "Error";
        }
    }
}
