<?php

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 10:53 AM
 */
class Loader
{
    /**
     * @param string $dataPath
     * @return World
     * @throws ErrorException
     */
    public static function createWorld(string $dataPath) {
        try {
            $config = include $dataPath.'config/world.php';
        } catch (Exception $e) {
            throw new ErrorException("Error while reading config file {$dataPath}config/world.php: {$e->getMessage()}");
        }

        $world = new World();
        foreach ($config['maps'] as $name) {
            $map = new Map();
            try {
                $map->load($dataPath."maps/$name");
            } catch (Exception $e) {
                throw new ErrorException("Error while loading $name");
            }
            $world->addMap($map);
        }

        return $world;
    }
}