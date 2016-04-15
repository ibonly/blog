<?php

require "../../vendor/autoload.php";

use Ibonly\PotatoORM\Schema;


$table = new Schema;
$table->field('increments', 'id');
$table->field('strings', 'name', 50);
$table->field('strings', 'link', 255);
$table->field('strings', 'description', 500);
$table->field('dateTime', 'date_created');
$table->field('primaryKey', 'id');
$table->field('unique', 'name');

echo $table->createTable('blog_menu');