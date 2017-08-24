<?php
/**
 * Created by PhpStorm.
 * User: Avinash
 * Date: 24-08-2017
 * Time: 23:28
 */

namespace Cimpress\RepoBundle\Twig;


use Cimpress\RepoBundle\Utility\Utils;

class CustomTwigExtensions extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('formatSize', array($this, 'formatSizeFilter')),
        );
    }

    /**
     * Function to replace all special characters by hyphen
     * @param float $size
     * @param int $precision
     * @return mixed|string
     */
    public function formatSizeFilter($size, $precision = 2)
    {
        $formattedSize = Utils::formatBytes($size, $precision);

        return $formattedSize;
    }
}