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
}