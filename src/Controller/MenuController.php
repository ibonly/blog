<?php

namespace Ibonly\Blog;

use Ibonly\Blog\Menu;

$menu = new Menu();

$menu->id = NULL;
$menu->name = $_POST['name'];
$menu->description = $_POST['description'];
$menu->date_created = date('Y-m-d H:i:s');

$save = $menu->save();

if ($save) {
    return "Done";
} else {
    return "Error";
}
