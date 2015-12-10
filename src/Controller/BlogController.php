<?php

namespace Ibonly\Blog;

use Ibonly\Blog\Menu;
use Ibonly\Blog\Content;
use Ibonly\Blog\Sub_Menu;
use Ibonly\Blog\Controller;

class BlogController extends Controller
{
    protected $menu;
    protected $content;
    protected $submenu;

    public function __construct()
    {
        $this->menu = new Menu();
        $this->content = new Content();
        $this->submenu = new Sub_Menu();
    }

    public function getMenu()
    {
        return $this->menu->getALL()->all();
    }

    public function getAllContent()
    {
        return $this->content->getALL()->all();
    }

    public function getmenuContent($name)
    {
        $id = $this->menu->where(['name' => $name])->first()->id;

        return $this->content->where([ 'menu_id' => $id])->all();
    }

    public function getContent($id)
    {
        return $this->content->where([ 'id' => $id])->first();
    }
}