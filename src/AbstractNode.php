<?php
namespace Hurl;
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 03:30
 */
abstract class AbstractNode implements NodeInterface
{

    /**
     * @param callable $do
     * @return AbstractNode
     */
    public function each(callable $do)
    {
        return $this->call(ArrayNode::each($do));
    }


    /**
     * @param callable $do
     * @return AbstractNode
     */
    public function call(callable $do)
    {
        return new NodeContainer($this, $do);
    }

    /**
     * @param callable $do
     * @return AbstractNode
     */
    public function then(callable $do)
    {
        return $this->call($do);
    }

    /**
     * @param callable $callable
     * @return AbstractNode
     */
    public function map(callable $callable)
    {
        return $this->call(ArrayNode::map($callable));
    }

    /**
     * @param callable $callable
     * @return AbstractNode
     */
    public function sort(callable $callable)
    {
        return $this->call(ArrayNode::sort($callable));
    }

    /**
     * @return AbstractNode
     */
    public function debug()
    {
        return $this->call(Node::debug());
    }

    /**
     * @param string $delimiter
     * @return AbstractNode
     */
    public function explode(string $delimiter)
    {
        return $this->call(ArrayNode::explode($delimiter));
    }

    /**
     * @param string $glue
     * @return AbstractNode
     */
    public function implode(string $glue)
    {
        return $this->call(ArrayNode::implode($glue));
    }

    /**
     * @return AbstractNode
     */
    public function fromJson()
    {
        return $this->call(Node::fromJson());
    }

    /**
     * @return AbstractNode
     */
    public function toJson()
    {
        return $this->call(Node::toJson());
    }

    /**
     * @return AbstractNode
     */
    public function trim()
    {
        return $this->call(StringNode::trim());
    }

    /**
     * @return AbstractNode
     */
    public function ltrim()
    {
        return $this->call(StringNode::ltrim());
    }

    /**
     * @return AbstractNode
     */
    public function rtrim()
    {
        return $this->call(StringNode::rtrim());
    }

    /**
     * @return AbstractNode
     */
    public function ucfirst()
    {
        return $this->call(StringNode::ucfirst());
    }

    /**
     * @return AbstractNode
     */
    public function lcfirst()
    {
        return $this->call(StringNode::lcfirst());
    }

    /**
     * @return AbstractNode
     */
    public function upper_case()
    {
        return $this->call(StringNode::upper_case());
    }

    /**
     * @return AbstractNode
     */
    public function lower_case()
    {
        return $this->call(StringNode::lower_case());
    }

    /**
     * @param $start
     * @param null $length
     * @return AbstractNode
     */
    public function substring($start, $length = null)
    {
        return $this->call(StringNode::substring($start, $length));
    }


    /**
     * @return AbstractNode
     */
    public function sum()
    {
        return $this->call(Node::sum());
    }

}