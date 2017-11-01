<?php namespace Hurl\Node\Interfaces\Traits;


use Hurl\Node\Interfaces\NodeInterface;

interface FilterContainerTraitInterface extends NodeInterface
{
    public function not();

    public function __invoke(... $args);

    /**
     * @param callable $then
     * @return NodeInterface
     */
    public function then(callable $then);

    public function fold($value);
}