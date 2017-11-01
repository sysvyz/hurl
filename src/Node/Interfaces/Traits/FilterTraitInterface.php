<?php namespace Hurl\Node\Interfaces\Traits;


use Hurl\Node\Interfaces\FilterInterface;
use Hurl\Node\Interfaces\NodeInterface;

interface FilterTraitInterface extends NodeInterface, FilterInterface
{
	public function __invoke(... $args);

	/**
	 * @param callable $then
	 * @return NodeInterface
	 */
	public function then(callable $then);

	public function apply($value);

	public function not();
}