<?php namespace Hurl\Node\Interfaces;


interface FilterInterface extends NodeInterface
{

	public function not();

	public function __invoke(... $args);

	/**
	 * @param callable $then
	 * @return NodeInterface
	 */
	public function then(callable $then);
}