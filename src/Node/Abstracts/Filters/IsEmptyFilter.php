<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:48
 */

namespace Hurl\Node\Abstracts\Filters;

use Hurl\Node\Abstracts\AbstractFilter;

abstract class IsEmptyFilter extends AbstractFilter
{

	public function apply($value)

	{
		if (is_string($value)) {
			return strlen($value) == 0;
		}
		if (is_array($value)) {
			return empty($value);
		}
		return false;
	}
}