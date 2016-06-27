<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 04:18
 */

namespace Hurl\Node\Interfaces;


interface ComparatorFilterTraitInterface
{
	public function compare($that, $other);
}