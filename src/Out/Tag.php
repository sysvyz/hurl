<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 20:29
 */

namespace Hurl\Out;


use Hurl\Node\Statics\Arrays;

/**
 * Class Tag
 * @package Hurl\Out
 * @method static Tag li
 * @method static Tag ul
 */
class Tag
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var array
     */
    protected $attributes = [];
    /**
     * @var array
     */
    protected $content = [];

    /**
     * Tag constructor.
     * @param $name
     * @param array $attributes
     * @param array $content
     */
    public function __construct(string $name, array $content = [], array $attributes = [])
    {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->content = $content;
    }

    /**
     * @param $name
     * @param array $attributes
     * @param array $content
     * @return Tag
     */
    public static function init($name, array $content = [], array $attributes = [])
    {
        return new self($name, $content, $attributes);
    }

    /**
     * @param $name
     * @param $arguments
     * @return Tag
     */
    public static function __callStatic($name, $arguments)
    {
        return self::init($name, ...$arguments);
    }

    function __toString()
    {
        $mapimplode = Arrays::recursiveMerge()->map(function ($e) {

            return $e . '';
        })->implode('');

        $elem = TagNode::element($this->name, $this->attributes);

        return '' . $elem($mapimplode($this->content));
    }

    /**
     * @return mixed
     * @codeCoverageIgnore
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     * @codeCoverageIgnore
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return array
     * @codeCoverageIgnore
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $name
     * @return Tag
     * @codeCoverageIgnore
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param array $attributes
     * @return Tag
     * @codeCoverageIgnore
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }
    /**
     * @param array $attributes
     * @return Tag
     * @codeCoverageIgnore
     */
    public function addAttributes($name,$attribute)
    {
        $this->attributes[$name] = $attribute;
        return $this;
    }

    /**
     * @param array $content
     * @return Tag
     * @codeCoverageIgnore
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }


    /**
     * @param array ...$content
     * @return $this
     */
    public function inner(... $content)
    {

        $this->content = $content;
        return $this;
    }

}