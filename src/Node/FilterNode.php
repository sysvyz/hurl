<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:34
 */

namespace Hurl\Node;


class FilterNode
{
    /**
     * @return AbstractNode
     */
    public static function isEmpty()
    {
        return new class() extends AbstractNode
        {
            public function __invoke(...$data)
            {
                return empty($data[0]);
            }
        };
    }

    /**
     * @return AbstractNode
     */
    public static function isNumeric()
    {
        return new class() extends AbstractNode
        {
            public function __invoke(...$data)
            {
                return is_numeric($data[0]);
            }
        };
    }

    /**
     * @return AbstractNode
     */
    public static function isInt()
    {
        return new class() extends AbstractNode
        {
            public function __invoke(...$data)
            {
                return is_int($data[0]);
            }
        };
    }
    /**
     * @return AbstractNode
     */
    public static function isString()
    {
        return new class() extends AbstractNode
        {
            public function __invoke(...$data)
            {
                return is_string($data[0]);
            }
        };
    }

    /**
     * @return AbstractNode
     */
    public static function isArray()
    {
        return new class() extends AbstractNode
        {
            public function __invoke(...$data)
            {
                return is_array($data[0]);
            }
        };
    }

}