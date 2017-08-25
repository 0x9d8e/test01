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
        $data = file_get_contents($url);
        $data = mb_convert_encoding($data, "utf-8", "windows-1251");

        return $data;
    }

}