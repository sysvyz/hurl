<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 03:05
 */

namespace Hurl\Node\Abstracts;

use Hurl\Node\StringNode;

abstract class AbstractStringNode extends AbstractNode
{

	/**
	 * @return AbstractStringNode
	 */
	public function trim()
	{
		return $this->call(StringNode::trim());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function ltrim()
	{
		return $this->call(StringNode::ltrim());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function rtrim()
	{
		return $this->call(StringNode::rtrim());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function ucfirst()
	{
		return $this->call(StringNode::ucfirst());
	}

	/**
	 * @return AbstractNode
	 */
	public function AbstractStringNode()
	{
		return $this->call(StringNode::lcfirst());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function upper_case()
	{
		return $this->call(StringNode::upper_case());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function lower_case()
	{
		return $this->call(StringNode::lower_case());
	}

	/**
	 * @param $start
	 * @param null $length
	 * @return AbstractStringNode
	 */
	public function substring($start, $length = null)
	{
		return $this->call(StringNode::substring($start, $length));
	}


}