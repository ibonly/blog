<?php

require 'vendor/autoload.php';

use Slim\Slim;
use Ibonly\Blog\MenuController;
date_default_timezone_set('Africa/Lagos');

$menu = new MenuController();

$app = new Slim( array(
        'templates.path' => 'resources/view',
        'view' => new \Slim\Views\Twig()
    ));

$twigView = $app->view();
$twigView->parserOptions = array(
        'debug' => false
    );
$twigView->parserDirectory = 'Twig';
$twigView->parserExtensions = array(
        new \Slim\Views\TwigExtension()
);

$app->get('/', function () use ($app, $menu) {
    $app->render('home.html.twig');
});

$app->post('/menu/create', function () use ($menu) {
    return $menu->insertMenu($_POST['name'], $_POST['description']);
});

$app->run();