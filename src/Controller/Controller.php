<?php

namespace Ibonly\Blog;

class Controller
{
    public function addDashToTitle($title)
    {
        return str_replace(' ', '-', $title);
    }

    public function removeDashToTitle($title)
    {
        return str_replace('-', ' ', $title);
    }

    public function removeAllDash($content, $field)
    {
        foreach ($content as $key) {
            $key->link = $key->$field;
            $key->$field = $this->removeDashToTitle($key->$field);
        }
        return $content;
    }

    public function removeSingleDash($content, $field)
    {
        $content->link = $content->$field;
        $content->$field = $this->removeDashToTitle($content->$field);

        return $content;
    }
}