<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 17.07.16
 * Time: 13:46
 */

namespace Hurl\Node\Comparator;



use Cofi\Comparator;

class ArrayComparator extends AbstractContainerComparator
{
	/**
	 * @param $fields
	 * @return Comparator\Abstracts\AbstractContainerComparator
	 */
	protected function _getComparator($fields)
	{
		return Comparator\ArrayComparator::init($fields);
	}
}