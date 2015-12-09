<?php

namespace Ibonly\Blog;

use Ibonly\Blog\Sub_Menu;

$menu = new Sub_Menu();

$menu->id = NULL;
$menu->menu_id = $_POST['menu_id'];
$menu->name = $_POST['name'];
$menu->description = $_POST['description'];
$menu->date_created = date('Y-m-d H:i:s');

$save = $menu->save();

if ($save) {
    return "Done";
} else {
    return "Error";
}
