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
        if(!file_exists('kinocache.tmp')) {
            $data = file_get_contents($url);
            file_put_contents('kinocache.tmp', $data);
        } else {
            $data = file_get_contents('kinocache.tmp');
        }

        return $data;
    }

}