<?php
namespace Core;


abstract class Entity
{
    /**
     * @return array
     */
    public function toArray($recursive = true)
    {
        $array = [];
        foreach ($this as $key => $value) {
            if(is_null($value))
                continue;

            if(is_object($value)) {
                if($recursive && method_exists($value, 'toArray'))
                    $array[$key] = $value->toArray(true);

                continue;
            }
        }

        return $array;
    }
}