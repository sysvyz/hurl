<?php
namespace Hurl\Node\Abstracts;

use Hurl\Node\Interfaces\ContainerTraitInterface;
use Hurl\Node\Interfaces\NodeInterface;
use Hurl\Node\Statics\_Array;
use Hurl\Node\Statics\_Node;
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
		return $this->then(_Node::debug());
	}
	

	/**
	 * @return AbstractNode
	 */
	public function fromJson()
	{
		return $this->then(_Node::fromJson());
	}

	/**
	 * @return AbstractNode
	 */
	public function toJson()
	{
		return $this->then(_Node::toJson());
	}

	public function asClosure()
	{

		return function (...$args) {
			return $this(...$args);
		};
	}


}