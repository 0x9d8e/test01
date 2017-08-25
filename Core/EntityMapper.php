<?php

namespace Core;


abstract class EntityMapper
{
    protected $entity;
    private static $stmt = [
        'insert' => [],
        'update' => []
    ];

    public function __construct(Entity $entity)
    {
        $this->entity = $entity;
    }

    abstract protected static function newStmt($type);

    protected static function getStmt($type)
    {
        if (!isset(self::$stmt[$type][static::class]))
            self::$stmt[$type][static::class] = static::newStmt($type);

        return self::$stmt[$type][static::class];
    }

    abstract public function save();

    /**
     * @return array
     */
    protected function getEntityAsArray()
    {
        return $this->entity->toArray(false);
    }
}