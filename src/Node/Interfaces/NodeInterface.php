<?php namespace Hurl\Node\Interfaces;

interface NodeInterface
{

    public function __invoke(... $args);

    /**
     * @param callable $then
     * @return NodeInterface
     */
    public function then(callable $then);

    /**
     * @return \Closure
     */
    public function asClosure();

}