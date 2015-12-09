<?php
require "../../vendor/autoload.php";
// namespace Ibonly\Blog;

use Ibonly\PotatoORM\Schema;


$table = new Schema;
$table->field('increments', 'id');
$table->field('strings', 'username', 50);
$table->field('strings', 'password', 500);
$table->field('dateTime', 'date_created');
$table->field('primaryKey', 'id');
$table->field('unique', 'username');

echo $table->createTable('user');