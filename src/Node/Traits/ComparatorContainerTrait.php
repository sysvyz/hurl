<?php
namespace Hurl\Node\Traits;

use Hurl\Node\Interfaces\ComparatorInterface;


/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 03:30
 */
trait ComparatorContainerTrait
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
		$cmp = $this->getBefore()->compare($a, $b);
		if ($cmp) {
			return $cmp;
		}
		return $this->getAfter()->compare($a, $b);
	}

	/**
	 * @return ComparatorInterface
	 */
	public function getBefore()
	{
		return $this->before;
	}

	/**
	 * @return ComparatorInterface
	 */
	public function getAfter()
	{
		return $this->after;
	}


}