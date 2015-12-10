<?php

namespace Ibonly\Blog;

class Controller
{
    public function addDashToTitle ($title)
    {
        return str_replace(' ', '-', $title);
    }

    public function removeDashToTitle ($title)
    {
        return str_replace('-', ' ', $title);
    }

    public function removeAllDash ($object, $field, $content)
    {
        foreach ($object as $key) {
            $key->short = implode(' ', array_slice(explode(' ', $key->$content), 0, 50));
            $key->link = $key->$field;
            $key->$field = $this->removeDashToTitle($key->$field);
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
}