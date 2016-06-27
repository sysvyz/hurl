<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 04:02
 */
namespace Hurl\Node\Interfaces;

use Hurl\Node\Abstracts\AbstractNode;
use Type\AbstractArrayEach;
use Type\AbstractArrayMap;
use Type\AbstractArraySort;

interface CollectionNodeInterface extends NodeInterface
{

	public function __invoke(... $args);

	/**
	 * @param callable $do
	 * @return AbstractNode
	 */
	public function call(callable $do);

	/**
	 * @param callable $do
	 * @return AbstractArrayEach
	 */
	public function each(callable $do);

	/**
	 * @param callable $callable
	 * @return AbstractArrayMap
	 */
	public function map(callable $callable);

	/**
	 * @param \callable[] ...$callable
	 * @return AbstractArraySort
	 */
	public function sort(callable ...$callable);

	/**
	 * @return AbstractArraySort
	 */
	public function merge();

	/**
	 * @return AbstractArraySort
	 */
	public function values();

	/**
	 * @return AbstractNode
	 */
	public function debug();

	/**
	 * @param string $glue
	 * @return AbstractNode
	 */
	public function implode(string $glue);

	/**
	 * @return AbstractNode
	 */
	public function toJson();
}