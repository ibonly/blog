<?php

require 'vendor/autoload.php';

use Slim\Slim;

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
    // $menus = $menu->getALL()->all();
    $app->render('home.html.twig');
});

$app->run();