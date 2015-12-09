<?php

require "../../vendor/autoload.php";

use Ibonly\PotatoORM\Schema;


$table = new Schema;
$table->field('increments', 'id');
$table->field('integer', 'menu_id', 50);
$table->field('strings', 'blog_title', 200);
$table->field('s', 'blog_content');
$table->field('dateTime', 'blog_content');
$table->field('primaryKey', 'id');

echo $table->createTable('content');