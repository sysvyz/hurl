<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 30.06.16
 * Time: 01:37
 */

namespace Hurl\Node\Abstracts\Filters;

use Hurl\Node\Abstracts\AbstractFilter;

abstract class ContainsFilter extends AbstractFilter
{

	private $needle;
	private $strict;

	/**
	 * ContainsFilter constructor.
	 * @param $needle
	 */
	public function __construct($needle,$strict = null)
	{
		$this->needle = $needle;
		$this->strict = $strict;
	}


	public function apply($value)
	{
		return in_array($this->needle,$value,$this->strict);
	}
}