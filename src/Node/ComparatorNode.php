<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:34
 */

namespace Hurl\Node;


abstract class ComparatorNode
{
    /**
     * @return AbstractComparator
     */
    public static function numeric()
    {
        return new class() extends AbstractComparator
        {

            /**
             * @param $a
             * @param $b
             * @return int
             */
            public static function compare($a, $b)
            {
                return $a - $b;
            }
        };
    }

    /**
     * @return AbstractComparator
     */
    public static function alphaNumeric()
    {
        return new class() extends AbstractComparator
        {

            /**
             * @param $a
             * @param $b
             * @return int
             */
            public static function compare($a, $b)
            {
                return strcmp($a, $b);
            }

        };
    }

    /**
     * @return AbstractComparator
     */
    public static function stringLength()
    {
        return new class() extends AbstractComparator
        {
            public static function compare($a, $b)
            {

                return strlen($a) - strlen($b);
            }
        };
    }

}
