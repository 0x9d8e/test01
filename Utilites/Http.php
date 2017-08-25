<?php

namespace Utilites;

class Http
{

    /**
     * @param $url
     * @return string
     */
    public function get($url)
    {
        return file_get_contents($url);
    }

}