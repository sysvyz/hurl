<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 03:05
 */

namespace Hurl\Node\Abstracts;

use Hurl\Node\Interfaces\CollectionNodeInterface;
use Hurl\Node\Statics\_String;

abstract class AbstractStringNode extends AbstractNode
{

	/**
	 * @return AbstractStringNode
	 */
	public function trim()
	{
		return $this->then(_String::trim());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function ltrim()
	{
		return $this->then(_String::ltrim());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function rtrim()
	{
		return $this->then(_String::rtrim());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function ucfirst()
	{
		return $this->then(_String::ucfirst());
	}

	/**
	 * @return AbstractNode
	 */
	public function AbstractStringNode()
	{
		return $this->then(_String::lcfirst());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function upper_case()
	{
		return $this->then(_String::upper_case());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function lower_case()
	{
		return $this->then(_String::lower_case());
	}

	/**
	 * @param string $delimiter
	 * @return CollectionNodeInterface
	 */
	public function explode(string $delimiter)
	{
		return $this->then(_String::explode($delimiter));
	}

	/**
	 * @param $start
	 * @param null $length
	 * @return AbstractStringNode
	 */
	public function substring($start, $length = null)
	{
		return $this->then(_String::substring($start, $length));
	}


}
