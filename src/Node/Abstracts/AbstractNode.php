<?php
namespace Hurl\Node\Abstracts;

use Hurl\Node\Interfaces\Traits\ContainerTraitInterface;
use Hurl\Node\Interfaces\NodeInterface;
use Hurl\Node\Statics\Arrays;
use Hurl\Node\Statics\Nodes;
use Hurl\Node\Traits\ContainerTrait;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 03:30
 */
abstract class AbstractNode implements NodeInterface
{


	/**
	 * @param callable $do
	 * @return AbstractNode
	 */
	public function then(callable $do)
	{
		return new class($this, $do) extends AbstractNode implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}
	

	/**
	 * @return AbstractNode
	 */
	public function debug()
	{
		return $this->then(Nodes::debug());
	}
	

	/**
	 * @return AbstractNode
	 */
	public function fromJson()
	{
		return $this->then(Nodes::fromJson());
	}

	/**
	 * @return AbstractNode
	 */
	public function toJson()
	{
		return $this->then(Nodes::toJson());
	}

	public function asClosure()
	{

		return function (...$args) {
			return $this(...$args);
		};
	}


}