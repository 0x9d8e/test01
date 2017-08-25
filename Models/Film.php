<?php
namespace Models;


class Film extends \Core\Entity
{

    public function toArray($recursive = true)
    {
        $array = [
            'name' => $this->name,
            'year' => $this->year
        ];

        if(isset($this->id))
            $array['id'] = $this->id;

        return $array;
    }

    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $position;

    /**
     * @var string
     */
    public $name;

    /**
     * @var integer
     */
    public $year;

    /**
     * @var float
     */
    public $rating;

    /**
     * @var integer
     */
    public $votes;

    /**
     * Timestamp
     * @var integer
     */
    public $date;

}