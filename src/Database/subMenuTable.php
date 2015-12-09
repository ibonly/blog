<?php

require "../../vendor/autoload.php";

use Ibonly\PotatoORM\Schema;


$table = new Schema;
$table->field('increments', 'id');
$table->field('integer', 'menu_id', 50);
$table->field('strings', 'name', 50);
$table->field('strings', 'description', 500);
$table->field('dateTime', 'date_created');
$table->field('primaryKey', 'id');
$table->field('unique', 'name');
$table->field('foreignKey', 'menu_id', 'menus_id');
// $table->field('foreignKey', 'local_gov', 'lgas_scode');

echo $table->createTable('sub_menu');