<?php
require "../../vendor/autoload.php";
// namespace Ibonly\Blog;

use Ibonly\PotatoORM\Schema;


$table = new Schema;
$table->field('increments', 'id');
$table->field('strings', 'username', 50);
$table->field('strings', 'name', 255);
$table->field('strings', 'password', 500);
$table->field('strings', 'role');
$table->field('strings', 'biography', 500);
$table->field('strings', 'avatar', 255);
$table->field('dateTime', 'date_created');
$table->field('primaryKey', 'id');
$table->field('unique', 'username');

echo $table->createTable('blog_user');