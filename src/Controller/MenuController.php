<?php

namespace Ibonly\Blog;

use Ibonly\Blog\Blog_Menu;
use Ibonly\Blog\Controller;

class MenuController extends Controller
{
    protected $menu;

    function __construct() {
        $this->menu = new Blog_Menu();
    }

    /**
     * Insert into menu table
     *
     * @param  $name
     * @param  $description
     *
     * @return bool
     */
    public function insertMenu ($name, $description)
    {
        $this->menu->id = NULL;
        $this->menu->name = $name;
        $this->menu->link = $this->addDashToTitle($name);
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
