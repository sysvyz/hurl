<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 17.07.16
 * Time: 13:46
 */

namespace Hurl\Node\Abstracts\Comparator;

use Cofi\Comparator;

class ObjectComparator extends AbstractContainerComparator
{
	/**
	 * @param $fields
	 * @return Comparator\Abstracts\AbstractContainerComparator
	 */
	protected function _getComparator($fields)
	{
		return Comparator\ObjectComparator::init($fields);
	}
}