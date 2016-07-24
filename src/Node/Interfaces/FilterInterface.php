<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 04:26
 */

namespace Hurl\Node\Interfaces;


use Cofi\Filter\Interfaces\FilterInterface as CofiFilterInterface;

interface FilterInterface extends NodeInterface , CofiFilterInterface
{

	public function not();

	public function __invoke(... $args);

	/**
	 * @param callable $then
	 * @return NodeInterface
	 */
	public function then(callable $then);
}