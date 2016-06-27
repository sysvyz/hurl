<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:38
 */

namespace Hurl\Node\Abstracts\Filters\Comparator;


use Hurl\Node\Interfaces\ComparatorFilterTraitInterface;
use Hurl\Node\Traits\ComparatorFilterTrait;

abstract class GreaterThanFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return is_numeric($other) && $other > $that;
	}

	public function not()
	{
		return new class($this->value) extends LessOrEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}