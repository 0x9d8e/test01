<?php

namespace Models;


use Core\Entity;

class FilmRating extends Entity
{

    /**
     * @param Film $film
     * @return FilmRating
     */
    public static function createFromFilm(Film $film)
    {
        $instance = new static();

        if(is_null($film->id))
            throw new \Exception('Film id cannot be null!');

        $instance->film_id = $film->id;
        $instance->position = $film->position;
        $instance->votes = $film->votes;
        $instance->rating = $film->rating;
        $instance->date = $film->date;

        return $instance;
    }

    public function toArray($recursive = true)
    {
        return [
            'film_id' => $this->film_id,
            'date' => $this->date,
            'position' => $this->position,
            'rating' => $this->rating,
            'votes' => $this->votes
        ];
    }

    /**
     * @var integer
     */
    public $film_id;

    /**
     * @var string
     */
    public $date;

    /**
     * @var
     */
    public $position;

    /**
     * @var float
     */
    public $rating;

    /**
     * @var integer
     */
    public $votes;
}