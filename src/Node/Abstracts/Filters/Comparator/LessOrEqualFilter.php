<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:39
 */

namespace Hurl\Node\Abstracts\Filters\Comparator;


use Hurl\Node\Interfaces\ComparatorFilterTraitInterface;
use Hurl\Node\Traits\ComparatorFilterTrait;

abstract class LessOrEqualFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return is_numeric($other) && $other <= $that;
	}

	public function not()
	{
		return new class($this->value) extends GreaterThanFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}