<?php namespace Hurl\Node\Interfaces;

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