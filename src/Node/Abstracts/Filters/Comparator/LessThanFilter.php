<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:40
 */

namespace Hurl\Node\Abstracts\Filters\Comparator;


use Hurl\Node\Interfaces\ComparatorFilterTraitInterface;
use Hurl\Node\Traits\ComparatorFilterTrait;

abstract class LessThanFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return is_numeric($other) && $other < $that;
	}

	public function not()
	{
		return new class($this->value) extends GreaterOrEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}