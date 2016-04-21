<?php

namespace Ibonly\Blog;

use Ibonly\Blog\Blog_Menu;
use Ibonly\Blog\Blog_Content;
use Ibonly\Blog\Blog_Sub_Menu;
use Ibonly\Blog\Controller;

class BlogController extends Controller
{
    protected $menu;
    protected $content;
    protected $submenu;

    public function __construct()
    {
        $this->menu = new Blog_Menu();
        $this->content = new Blog_Content();
        $this->submenu = new Blog_Sub_Menu();
        $this->user = new Blog_User();
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
        $content = $this->content->where([ 'menu_id' => $id])->all();

        return $content;
    }

    public function getContent($id)
    {
        $content = $this->content->where([ 'blog_link' => $id])->first();
        $content->blog_content = htmlspecialchars_decode($content->blog_content);
        $content->blog_contentUpdate = htmlspecialchars_decode(str_replace('../', '../../', $content->blog_content));

        return $content;
    }

    public function author($contentId)
    {
        $content = $this->content->where([ 'blog_link' => $contentId])->first();
        $user = $this->user->where(['id' => $content->author])->first();

        return $user;
    }

    public function getRecentTitle()
    {
        return $this->content->getALL()->allDESC(10);

    }

    public function getRelatedPost()
    {
        return $this->content->getALL()->allDESC(3);
    }

    public function getSearch($title)
    {
        $content = $this->content->where([ 'blog_title' => $title], 'LIKE')->all();
        foreach ($content as $key) {
            $key->blog_content = htmlspecialchars_decode($key->blog_content);
        }
        return $content;
    }
}