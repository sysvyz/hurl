<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:51
 */

namespace Hurl\Node\Filters\Number;


use Hurl\Node\Abstracts\AbstractFilter;
use Hurl\Node\Interfaces\Traits\FilterTraitInterface;
use Hurl\Node\Traits\FilterTrait;

abstract class IsEvenFilter extends AbstractFilter
{
	public function apply($value)
	{
		return is_numeric($value) && $value % 2 == 0;
	}

	public function not()
	{
		return new class() extends IsOddFilter implements FilterTraitInterface
		{
			use FilterTrait;

		};
	}
}