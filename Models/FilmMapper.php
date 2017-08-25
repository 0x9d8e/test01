<?php

namespace Models;


use Core\EntityMapper;
use Core\Db;
use Core\StupidCache as cache;

class FilmMapper extends EntityMapper
{

    /**
     * @param null|string $date
     * @return Film[]
     */
    public static function findTop10($date = null)
    {
        if(!isset($date))
            $date = date('Y-m-d');

        if(cache::instance()->exists('kinopoiskTop10at'.$date))
            return cache::instance()->get('kinopoiskTop10at'.$date);

        $stmt = Db::instance()->prepare('
            SELECT 
                f.`id`, 
                f.`name`,
                f.`year`, 
                r.`rating`, 
                r.`position`,
                r.`votes`, 
                r.`date`
            FROM `films` f 
            LEFT JOIN `films_rating` r ON r.`film_id` = f.`id` 
            WHERE r.`date` = :date 
            ORDER BY r.`position`
        ');

        $stmt->execute(['date' => $date]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Models\Film');

        $data = $stmt->fetchAll();
        cache::instance()->set('kinopoiskTop10at'.$date, $data);
        
        return $data;
    }

    protected static function newStmt($type)
    {
        if($type === 'insert') {
            return Db::instance()->prepare('
              INSERT INTO `films` SET 
                `name` = :name, 
                `year` = :year
            ');
        } elseif ($type === 'update') {
            return Db::instance()->prepare('
              UPDATE `films` SET 
                `name` = :name, 
                `year` = :year
              WHERE 
                `id` = :id
            ');
        }
    }

    /**
     * @return boolean
     */
    protected function isNew()
    {
        $this->updateId();

        return is_null($this->entity->id);
    }

    private function updateId()
    {
        if(isset($this->entity->id))
            return;

        $stmt = Db::instance()
            ->prepare('SELECT `id` FROM `films` WHERE `name` = ?');

        $stmt->execute([$this->entity->name]);
        if($id = $stmt->fetch(\PDO::FETCH_COLUMN)) {
            $this->entity->id = $id;
        }
    }

    public function save()
    {
        $this->updateId();

        if($this->isNew()) {
            $stmt = static::getStmt('insert');
            $stmt->execute($this->getEntityAsArray());
            $this->entity->id = Db::instance()->lastInsertId();
        } else {
            $stmt = static::getStmt('update');
            $stmt->execute($this->getEntityAsArray());
        }
    }
}