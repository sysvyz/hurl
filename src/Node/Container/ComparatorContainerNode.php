<?php
namespace Hurl\Node\Container;

use Hurl\Node\ComparatorInterface;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 03:30
 */
trait ComparatorContainerNode
{
	/**
	 * @var ComparatorInterface
	 */
	private $before;
	/**
	 * @var ComparatorInterface
	 */
	private $after;


	/**
	 * ContainerNode constructor.
	 * @param ComparatorInterface $before
	 * @param ComparatorInterface $after
	 */
	public function __construct(ComparatorInterface $before, ComparatorInterface $after)
	{
		$this->before = $before;
		$this->after = $after;
	}


	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b)
	{
		$cmp = $this->before->compare($a, $b);
		if ($cmp) {
			return $cmp;
		}
		return $this->after->compare($a, $b);
	}


}