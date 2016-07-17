<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 17.07.16
 * Time: 13:46
 */

namespace Hurl\Node\Abstracts\Comparator;



class ObjectComparator extends AbstractContainerComparator
{
	protected function _isset(&$x, $field)
	{
		return isset($x->$field);
	}

	protected function _get(&$x, $field)
	{
		return $x->$field;
	}
}