<?php

namespace Services;

use Models\Film as Film;
use DiDom\Document;
use Models\FilmMapper;
use Models\FilmRating;
use Models\FilmRatingMapper;

class Kinopoisk
{
    const source = 'http://www.kinopoisk.ru/top/';

    public function update()
    {
        $this->fetch($this->load(), function (Film $film) {
            (new FilmMapper($film))->save();

            $filmRating = FilmRating::createFromFilm($film);
            (new FilmRatingMapper($filmRating))->save();
        });
    }

    private function load()
    {
        return (new \Utilites\Http())
            ->get(self::source);
    }

    private function fetch($string, callable $callback)
    {
        $document = new Document($string);

        for ($i = 1; $i <= 10; $i++) {
            $row = $document->first('#top250_place_' . $i);

            $film = new Film();
            $film->position = $i;

            $nameNode = $row->first('td a.all');
            $name = trim($nameNode->text());
            $m = [];
            preg_match("/\(([0-9]+)\)/", $name, $m);
            $film->year = (int)$m[1];

            $name = str_replace('('.$film->year.')', '', $name);

            $film->name = $name;

            $originalNameNode = $row->first('td span.text-grey');
            if(!is_null($originalNameNode))
                $film->name = trim($originalNameNode->text());

            $ratingNode = $row->first('td div a.continue');
            $film->rating = floatval(trim($ratingNode->text()));

            $votesNode = $row->first('td:nth-child(3) div a.continue');

            $votes = $votesNode->text();
            $votes = preg_replace("/[^0-9]/", "", $votes);

            $film->votes = (int)$votes;

            $film->date = date('Y-m-d');

            $callback($film);
        }
    }
}