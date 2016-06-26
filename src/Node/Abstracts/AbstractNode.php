<?php
namespace Hurl\Node\Abstracts;

use Hurl\Node\ArrayNode;
use Hurl\Node\Container\ContainerNode;
use Hurl\Node\Node;
use Hurl\Node\NodeInterface;

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
		return new class($this,$do) extends AbstractNode
		{
			use ContainerNode;
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
		return $this->call(Node::debug());
	}

	/**
	 * @param string $delimiter
	 * @return AbstractNode
	 */
	public function explode(string $delimiter)
	{
		return $this->call(ArrayNode::explode($delimiter));
	}

	/**
	 * @param string $glue
	 * @return AbstractNode
	 */
	public function implode(string $glue)
	{
		return $this->call(ArrayNode::implode($glue));
	}

	/**
	 * @return AbstractNode
	 */
	public function fromJson()
	{
		return $this->call(Node::fromJson());
	}

	/**
	 * @return AbstractNode
	 */
	public function toJson()
	{
		return $this->call(Node::toJson());
	}


}