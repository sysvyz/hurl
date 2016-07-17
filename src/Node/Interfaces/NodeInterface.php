<?php
namespace Hurl\Node\Interfaces;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 03:26
 */
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