<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 04:26
 */

namespace Hurl\Node\Interfaces;


interface FilterTraitInterface extends NodeInterface, FilterInterface
{
	public function __invoke(... $args);

	/**
	 * @param callable $then
	 * @return NodeInterface
	 */
	public function call(callable $then);

	public function apply($value);

	public function not();
}