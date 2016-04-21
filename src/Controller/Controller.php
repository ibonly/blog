<?php

namespace Ibonly\Blog;

class Controller
{

    public function removeDashToTitle ($title)
    {
        return str_replace('_', ' ', $title);
    }

    public function shortWord($content)
    {
        return implode(' ', array_slice(explode(' ', $key->$content), 0, 50));
    }

    public function removeAllDash ($object, $field, $content)
    {
        var_dump($object); die();
        foreach ($object as $key => $values) {
            $key->link = $key->$field;
        }

        return $object;
    }

    public function removeSingleDash ($content, $field, $short)
    {
        $content->short = implode(' ', array_slice(explode(' ', $content->$short), 0, 50));
        $content->link = $content->$field;
        $content->$field = $this->removeDashToTitle($content->$field);

        return $content;
    }

    public function clean($string) 
    {
        $string = str_replace(' ', '-', trim(strtolower($string))); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}