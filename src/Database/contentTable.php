<?php

require "../../vendor/autoload.php";

use Ibonly\PotatoORM\Schema;


$table = new Schema;
$table->field('increments', 'id');
$table->field('integer', 'menu_id', 50);
$table->field('integer', 'author', 3);
$table->field('strings', 'blog_title', 200);
$table->field('strings', 'blog_link', 200);
$table->field('text', 'blog_description');
$table->field('text', 'blog_content');
$table->field('strings', 'blog_image', 225);
$table->field('dateTime', 'date_created');
$table->field('primaryKey', 'id');
$table->field('foreignKey', 'menu_id', 'blog_menus-id');
$table->field('foreignKey', 'author', 'blog_users-id');

echo $table->createTable('blog_content');