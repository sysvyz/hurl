<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:43
 */

namespace Hurl\Node\Abstracts\Filters\Comparator;


use Hurl\Node\Interfaces\ComparatorFilterTraitInterface;
use Hurl\Node\Traits\ComparatorFilterTrait;


abstract class IsEqualFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return $other == $that;
	}

	public function not()
	{
		return new class($this->value) extends IsNotEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}