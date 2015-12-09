<?php

namespace Ibonly\Blog;

use Ibonly\Blog\Content;

$content = new Content();

$content->id = NULL;
$content->menu_id = $_POST['menu_id'];
$content->blog_title = $_POST['title'];
$content->blog_content = $_POST['content'];
$content->date_created = date('Y-m-d H:i:s');

$save = $content->save();

if ($save) {
    return "Done";
} else {
    return "Error";
}
