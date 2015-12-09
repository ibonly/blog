<?php

namespace Ibonly\Blog;

use Ibonly\Blog\Menu;

$menu = new Menu();

$menu->id = NULL;
$menu->name = $_POST['name'];
$menu->description = $_POST['description'];

$save = $menu->save();

if ($save) {
    return "Done";
} else {
    return "Error";
}
