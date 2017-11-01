<?php namespace Hurl\Node\Interfaces;


use Cofi\Filter\Interfaces\FilterInterface as CofiFilterInterface;

interface FilterInterface extends NodeInterface, CofiFilterInterface
{

    public function not();

    public function __invoke(... $args);

    /**
     * @param callable $then
     * @return NodeInterface
     */
    public function then(callable $then);
}