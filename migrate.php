<?php
define('ROOT_PATH', __DIR__.'/');

require_once ROOT_PATH.'/autoload.php';

$queries = [
    'SET FOREIGN_KEY_CHECKS=0;',

    'CREATE TABLE `films` (
      `id` int(11) UNSIGNED NOT NULL,
      `name` varchar(255) NOT NULL,
      `year` int(4) UNSIGNED NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;',

    'CREATE TABLE `films_rating` (
      `film_id` int(11) UNSIGNED NOT NULL,
      `date` date NOT NULL,
      `rating` float UNSIGNED NOT NULL,
      `position` int(2) UNSIGNED NOT NULL,
      `votes` int(11) UNSIGNED NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;',

    'ALTER TABLE `films`
      ADD PRIMARY KEY (`id`),
      ADD UNIQUE KEY `name` (`name`);',

    'ALTER TABLE `films_rating`
      ADD PRIMARY KEY (`film_id`,`date`),
      ADD KEY `film_id` (`film_id`);',

    'ALTER TABLE `films`
    MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;',

    'ALTER TABLE `films_rating`
      ADD CONSTRAINT `films_rating_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;',

    'SET FOREIGN_KEY_CHECKS=1;'
];

foreach ($queries as $n => $query) {
    echo $n."...";
    \Core\Db::instance()->exec($query);
    echo " ok!".PHP_EOL;
}

echo "Succes!".PHP_EOL;
