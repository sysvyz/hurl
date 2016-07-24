<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 23:13
 */

namespace Hurl\Node\Interfaces;


use Cofi\Comparator\Interfaces\ComparatorInterface as CofiComparatorInterface;

interface ComparatorInterface extends CofiComparatorInterface
{
	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b);

	/**
	 * @return ComparatorInterface
	 */
	public function invert();
}