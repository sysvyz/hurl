<?php namespace Hurl;

/**
 * Class Object
 * @package Hurl
 */
class Object
{

    public function getHashValue()
    {
        return spl_object_hash($this);
    }

    public function equals($other)
    {
        return $this === $other;
    }
}