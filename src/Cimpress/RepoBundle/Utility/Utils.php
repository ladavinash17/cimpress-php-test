<?php
/**
 * Created by PhpStorm.
 * User: Avinash
 * Date: 24-08-2017
 * Time: 23:24
 */

namespace Cimpress\RepoBundle\Utility;


class Utils
{
    public static function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');

        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }
}