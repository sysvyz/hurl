<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:44
 */

namespace Hurl\Node\Filters;


use Hurl\Node\Abstracts\AbstractFilter;

abstract class IsStringFilter extends AbstractFilter
{
	public function apply($value)
	{
		return is_string($value);
	}
}