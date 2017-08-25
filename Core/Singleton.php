<?php
namespace Core;


abstract class Singleton
{

    private static $instances = [];

    public static function instance()
    {
        if(!isset(self::$instances[static::class]))
            self::$instances[static::class] = new static();

        return self::$instances[static::class];
    }

    protected abstract function __construct();
}