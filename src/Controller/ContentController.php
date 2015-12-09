<?php

namespace Ibonly\Blog;

use Ibonly\Blog\Content;

class Content
{
    protected $content;

    function __construct() {
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
        $this->content->blog_title = $title;
        $this->content->blog_content = $content;
        $this->content->date_created = date('Y-m-d H:i:s');

        $save = $this->content->save();

        if ($save) {
            return "Done";
        } else {
            return "Error";
        }
    }
}
