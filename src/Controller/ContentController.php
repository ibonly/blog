<?php

namespace Ibonly\Blog;

use Ibonly\Blog\Controller;
use Ibonly\Blog\Blog_Content;

class ContentController extends Controller
{
    protected $content;

    public function __construct()
    {
        $this->content = new Blog_Content();
    }

    /**
     * Insert into content table
     *
     * @param  $name
     * @param  $description
     *
     * @return bool
     */
    public function insertContent ()
    {
        $this->content->id               = NULL;
        $this->content->menu_id          = $_POST['menu_id'];
        $this->content->author           = $_SESSION['id'];
        $this->content->blog_title       = trim($_POST['title']);
        $this->content->blog_link        = $this->clean($_POST['title']);
        $this->content->blog_image       = $this->content->file($_FILES['cover'])->uploadFile($_SERVER['DOCUMENT_ROOT']."/uploads/");
        $this->content->blog_description = trim($_POST['description']);
        $this->content->blog_content     = trim($_POST['content']);
        $this->content->date_created     = date('Y-m-d H:i:s');
        
        $save = $this->content->save();

        return ($save) ? "Done" : "Error";
    }

    public function updateContent()
    {
        $this->content->blog_title       = $_POST['title'];
        $this->content->blog_link        = $this->clean($_POST['title']);
        $this->content->blog_description = $_POST['description'];
        $this->content->blog_content     = str_replace('../../', '../', $_POST['content']);
        $update = $this->content->update($_POST['id']);

        return ($update) ? "Done" : "Error";
    }
}
