<?php namespace Hurl\Node\Comparator;

use Hurl\Node\Abstracts\AbstractComparator;

class GenericComparator extends AbstractComparator
{
	private $func;

	/**
	 * GenericComparator constructor.
	 * @param $func
	 */
	public function __construct(callable $func)
	{
		$this->func = $func;
	}

	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b)
	{
		$f = $this->func;
		return $f($a, $b);
	}
}