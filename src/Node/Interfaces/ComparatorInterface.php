<?php namespace Hurl\Node\Interfaces;


interface ComparatorInterface
{
	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b);
}