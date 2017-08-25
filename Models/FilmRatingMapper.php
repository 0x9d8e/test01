<?php

namespace Models;


use Core\EntityMapper;

class FilmRatingMapper extends EntityMapper
{
    protected static function newStmt($type)
    {
        return \Core\Db::instance()->prepare('
              REPLACE INTO `films_rating` SET 
                `film_id` = :film_id, 
                `rating` = :rating,
                `position` = :position,
                `date` = :date,
                `votes` = :votes
            ');
    }

    public function save()
    {
        $stmt = static::getStmt('replace');
        $stmt->execute($this->getEntityAsArray());
    }
}