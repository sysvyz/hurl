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
	public function call(callable $do)
	{
		return new class($this, $do) extends AbstractNode implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}

	/**
	 * @param callable $do
	 * @return AbstractNode
	 */
	public function then(callable $do)
	{
		return $this->call($do);
	}

	/**
	 * @return AbstractNode
	 */
	public function debug()
	{
		return $this->call(_Node::debug());
	}

	/**
	 * @param string $delimiter
	 * @return AbstractNode
	 */
	public function explode(string $delimiter)
	{
		return $this->call(_Array::explode($delimiter));
	}

	/**
	 * @param string $glue
	 * @return AbstractNode
	 */
	public function implode(string $glue)
	{
		return $this->call(_Array::implode($glue));
	}

	/**
	 * @return AbstractNode
	 */
	public function fromJson()
	{
		return $this->call(_Node::fromJson());
	}

	/**
	 * @return AbstractNode
	 */
	public function toJson()
	{
		return $this->call(_Node::toJson());
	}

	public function asClosure()
	{

		return function (...$args) {
			return $this(...$args);
		};
	}


}