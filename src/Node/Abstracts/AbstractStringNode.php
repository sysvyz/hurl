<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 03:05
 */

namespace Hurl\Node\Abstracts;

use Hurl\Node\Interfaces\CollectionNodeInterface;
use Hurl\Node\Statics\Strings;

abstract class AbstractStringNode extends AbstractNode
{

	/**
	 * @return AbstractStringNode
	 */
	public function trim()
	{
		return $this->then(Strings::trim());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function ltrim()
	{
		return $this->then(Strings::ltrim());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function rtrim()
	{
		return $this->then(Strings::rtrim());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function ucfirst()
	{
		return $this->then(Strings::ucfirst());
	}

	/**
	 * @return AbstractNode
	 */
	public function AbstractStringNode()
	{
		return $this->then(Strings::lcfirst());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function upper_case()
	{
		return $this->then(Strings::upper_case());
	}

	/**
	 * @return AbstractStringNode
	 */
	public function lower_case()
	{
		return $this->then(Strings::lower_case());
	}

	/**
	 * @param string $delimiter
	 * @return CollectionNodeInterface
	 */
	public function explode(string $delimiter)
	{
		return $this->then(Strings::explode($delimiter));
	}

	/**
	 * @param $start
	 * @param null $length
	 * @return AbstractStringNode
	 */
	public function substring($start, $length = null)
	{
		return $this->then(Strings::substring($start, $length));
	}


}
