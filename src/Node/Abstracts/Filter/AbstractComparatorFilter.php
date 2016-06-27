<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:01
 */

namespace Hurl\Node\Abstracts\Filter;


use Hurl\Node\Abstracts\AbstractFilterNode;

abstract class AbstractComparatorFilter extends AbstractFilterNode
{
	protected $value;

	/**
	 *  constructor.
	 * @param $value
	 */
	public function __construct($value)
	{
		$this->value = $value;
	}

}