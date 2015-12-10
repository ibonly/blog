<?php

require 'vendor/autoload.php';

use Slim\Slim;
use Ibonly\Blog\BlogController;
use Ibonly\Blog\MenuController;
use Ibonly\Blog\ContentController;
use Ibonly\Blog\Sub_MenuController;

date_default_timezone_set('Africa/Lagos');

$menu = new MenuController();
$submenu = new Sub_MenuController();
$content = new ContentController();
$blog = new BlogController();

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

$app->get('/', function () use ($app, $blog) {

    $app->render('home.html.twig', [
        'menus' => $blog->getMenu(),
        'allContents' => $blog->getAllContent(),
        'recentPost' =>$blog->getRecentTitle()
    ]);
});

$app->get('/menu/:id', function ($id) use ($app, $blog) {

    $app->render('menu_list.html.twig', [
        'menus' => $blog->getMenu(),
        'contents' => $blog->getmenuContent($id),
        'recentPost' =>$blog->getRecentTitle()
    ]);
});

$app->get('/content/:id', function ($id) use ($app, $blog) {
    $app->render('content.html.twig', [
        'menus' => $blog->getMenu(),
        'blogContents' => $blog->getContent($id),
        'recentPost' =>$blog->getRecentTitle()
    ]);
});

$app->post('/search', function () use ($app, $blog) {

    $app->render('search.html.twig', [
        'menus' => $blog->getMenu(),
        'contents' => $blog->getSearch($_POST['search']),
        'recentPost' =>$blog->getRecentTitle()
    ]);
});



$app->get('/admin', function () use ($app, $blog) {
    $app->render('admin/home.html.twig', [
        'menus' => $blog->getMenu(),
        'contents' => $blog->getAllContent()
    ]);
});

$app->get('/admin/content', function () use ($app, $blog) {
    $app->render('admin/content.html.twig', [
        'menus' => $blog->getMenu()
    ]);
});
$app->get('/admin/menu', function () use ($app, $blog) {
    $app->render('admin/menu.html.twig', [
        'menus' => $blog->getMenu()
    ]);
});

$app->get('/admin/content/:id', function ($id) use ($app, $blog) {
    $app->render('admin/content_update.html.twig', [
        'menus' => $blog->getMenu(),
        'contents' => $blog->getContent($id)
    ]);
});

$app->post('/admin/menu/create', function () use ($menu) {
    echo $menu->insertMenu($_POST['name'], $_POST['description']);
});

$app->post('/admin/menu/sub_menu', function () use ($submenu) {
    echo $submenu->insertSubMenu($_POST['menu_id'], $_POST['submenu_name'], $_POST['submenu_description']);
});

$app->post('/admin/content', function () use ($content) {
    echo $content->insertContent($_POST['menu_id'], $_POST['title'], $_POST['content']);
});

$app->post('/admin/content/update', function () use ($content) {
    echo $content->updateContent($_POST['id'], $_POST['menu_id'], $_POST['title'], $_POST['content']);
});

$app->run();