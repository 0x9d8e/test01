<?php

namespace Core;


class StupidCache extends Singleton
{
    //Чтобы не читать файл лишний раз
    private $memory = [];

    public function get($key)
    {
        if(!isset($this->memory[$key]))
            $this->memory[$key] = $this->unserialize($this->read($key));

        return $this->memory[$key];
    }

    public function set($key, $value)
    {
        $this->memory[$key] = $value;
        $this->write($key, $this->serialize($value));
    }

    public function exists($key, $ttl = 600)
    {
        if(!file_exists(self::filename($key)))
            return false;

        return (filemtime(self::filename($key))+$ttl >= time());
    }

    public function flush($key)
    {
        unlink(self::filename($key));
    }

    private function serialize($value)
    {
        return serialize($value);
    }

    private function unserialize($value)
    {
        return unserialize($value);
    }

    private function write($key, $value)
    {
        file_put_contents(self::filename($key), $value);
    }

    private function read($key)
    {
        return file_get_contents(self::filename($key));
    }

    private static function filename($key)
    {
        return ROOT_PATH.'cache/'.$key.'.cache';
    }

    protected function __construct()
    {
    }
}