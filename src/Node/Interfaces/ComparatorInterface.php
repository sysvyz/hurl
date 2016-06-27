<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 23:13
 */

namespace Hurl\Node\Interfaces;


interface ComparatorInterface
{
	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b);
}