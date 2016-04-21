<?php

require 'vendor/autoload.php';

use Slim\Slim;
use Ibonly\Blog\BlogController;
use Ibonly\Blog\MenuController;
use Ibonly\Blog\UserController;
use Ibonly\Blog\ContentController;
use Ibonly\Blog\Sub_MenuController;

date_default_timezone_set('Africa/Lagos');
session_start();

$menu    = new MenuController();
$submenu = new Sub_MenuController();
$content = new ContentController();
$blog    = new BlogController();
$user    = new UserController();


$app = new Slim( array(
        'templates.path' => 'resources/view',
        'view'           => new \Slim\Views\Twig(),
        'debug'          => true
    ));

$twigView = $app->view();
$twigView->parserOptions = array(
        'debug' => false
    );
$twigView->parserDirectory = 'Twig';
$twigView->parserExtensions = array(
        new \Slim\Views\TwigExtension()
);

$app->error(function (\Ibonly\PotatoORM\DataNotFoundException $e) use ($app) {
    $app->render('error/404.html.twig');
});

$app->get('/', function () use ($app, $blog) {

    $app->render('home.html.twig', [
        'menus'       => $blog->getMenu(),
        'allContents' => $blog->getAllContent(),
        'recentPosts' => $blog->getRecentTitle()
    ]);
});

$app->get('/home', function () use ($app, $blog) {

    $app->render('home.html.twig', [
        'menus'         => $blog->getMenu(),
        'allContents'   => $blog->getAllContent(),
        'recentPosts'   => $blog->getRecentTitle()
    ]);
});

$app->get('/menu/:id', function ($id) use ($app, $blog) {

    $app->render('menu_list.html.twig', [
        'menus'       => $blog->getMenu(),
        'contents'    => $blog->getmenuContent($id),
        'recentPosts' =>$blog->getRecentTitle()
    ]);
});

$app->get('/content/:id', function ($id) use ($app, $blog) {
    $app->render('content.html.twig', [
        'menus'        => $blog->getMenu(),
        'blogContents' => $blog->getContent($id),
        'recentPosts'  => $blog->getRecentTitle(),
        'relatedPosts' => $blog->getRelatedPost(),
        'user'         => $blog->author($id)
    ]);
});

$app->post('/search', function () use ($app, $blog) {

    $app->render('search.html.twig', [
        'menus'       => $blog->getMenu(),
        'contents'    => $blog->getSearch($_POST['search']),
        'recentPosts' =>$blog->getRecentTitle()
    ]);
});

/*******************************************************************
|* *                     ADMIN ROUTE                            * *| 
 ******************************************************************/

$auth = function () {
    $app = \Slim\Slim::getInstance();
    return function () use ($app) {
        if ($_SESSION['login'] == false) {
            $app->redirect('/admin');
        }
    }; 
};

$app->get('/admin', function () use ($app, $blog) {
    $app->render('admin/login.html.twig');
});

$app->get('/admin/home', $auth(), function () use ($app, $blog) {
    $app->render('admin/home.html.twig', ['contents' => $blog->getAllContent()]);
});

$app->get('/admin/register', $auth(), function () use ($app) {
    $app->render('admin/register.html.twig');
});

$app->get('/admin/settings', $auth(), function () use ($app, $user) {
    $app->render('admin/settings.html.twig', [
        'user' => $user->getUser()
    ]);
});

$app->get('/admin/content', $auth(), function () use ($app, $blog) {
    $app->render('admin/content.html.twig', [
        'menus' => $blog->getMenu()
    ]);
});

$app->get('/admin/menu', $auth(), function () use ($app, $blog) {
    $app->render('admin/menu.html.twig', [
        'menus' => $blog->getMenu()
    ]);
});

$app->get('/admin/logout', $auth(), function () use ($app) {
    $_SESSION['login'] = false;
    $app->redirect('/admin');
});

$app->get('/admin/content/:id', $auth(), function ($id) use ($app, $blog) {
    $app->render('admin/content_update.html.twig', [
        'menus'    => $blog->getMenu(),
        'contents' => $blog->getContent($id)
    ]);
});

$app->post('/admin/login', function () use ($user) {
    echo $user->adminLogin();
});

$app->post('/admin/register', function () use ($user) {
    echo $user->adminRegisteration();
});

$app->post('/admin/update', function () use ($user) {
    echo $user->updateUserInfo();
});

$app->post('/admin/menu/create', function () use ($menu) {
    echo $menu->insertMenu($_POST['name'], $_POST['description']);
});

$app->post('/admin/menu/sub_menu', function () use ($submenu) {
    echo $submenu->insertSubMenu($_POST['menu_id'], $_POST['submenu_name'], $_POST['submenu_description']);
});

$app->post('/admin/content', function () use ($content) {
    echo $content->insertContent();
});

$app->post('/admin/content/update', function () use ($content) {
    echo $content->updateContent($_POST['id'], $_POST['menu_id'], $_POST['title'], $_POST['content']);
});

$app->run();