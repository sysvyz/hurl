<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:44
 */

namespace Hurl\Node\Filters\Comparator;


use Hurl\Node\Interfaces\Traits\ComparatorFilterTraitInterface;
use Hurl\Node\Traits\ComparatorFilterTrait;

abstract class IsNotEqualFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return $other != $that;
	}

	public function not()
	{
		return new class($this->value) extends IsEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}