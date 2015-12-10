<?php

namespace Ibonly\Blog;

use Ibonly\Blog\Content;
use Ibonly\Blog\Controller;

class ContentController extends Controller
{
    protected $content;

    public function __construct()
    {
        $this->content = new Content();
    }

    /**
     * Insert into content table
     *
     * @param  $name
     * @param  $description
     *
     * @return bool
     */
    public function insertContent ($menu_id, $title, $content)
    {
        $this->content->id = NULL;
        $this->content->menu_id = $menu_id;
        $this->content->blog_title = $this->addDashToTitle($title);
        $this->content->blog_content = $content;
        $this->content->date_created = date('Y-m-d H:i:s');

        $save = $this->content->save();

        if ($save) {
            return "Done";
        } else {
            return "Error";
        }
    }

    public function updateContent($id, $menu_id, $title, $content)
    {
        $find = Content::find($id);
        $find->menu_id = $menu_id;
        $find->blog_title = $this->addDashToTitle($title);
        $find->blog_content = $content;

        return $find->update();
    }
}
