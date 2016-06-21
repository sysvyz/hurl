<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 23:13
 */

namespace Hurl\Node;


interface ComparatorInterface
{
    /**
     * @param $a
     * @param $b
     * @return int
     */
    public static function compare($a, $b);
}