<?php namespace Hurl\Node\Interfaces\Traits;

use Hurl\Node\Interfaces\NodeInterface;


/**
 * Interface ContainerTraitInterface
 * @package Hurl\Node\Container
 */
interface ContainerTraitInterface extends NodeInterface
{

    public function getBefore();

    public function getAfter();
}
