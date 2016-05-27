<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 20:29
 */

namespace Hurl\Out;


use Hurl\Node;

class Tag
{
    public $name;
    public $attributes = [];
    public $content = [];

    /**
     * Tag constructor.
     * @param $name
     * @param array $attributes
     * @param array $content
     */
    public function __construct($name, array $attributes, array $content)
    {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->content = $content;
    }

    function __toString()
    {
        $mapimplode= Node::map(function ($e){
            return $e.'';
        })->implode('');

        $elem = TagNode::element($this->name,$this->attributes);

        return ''.$elem($mapimplode($this->content));
    }

}