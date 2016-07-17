<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 17.07.16
 * Time: 13:46
 */

namespace Hurl\Node\Abstracts\Comparator;


use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Hurl\Node\Abstracts\AbstractComparator;
use Hurl\Node\Interfaces\ComparatorInterface;
use Hurl\Node\Statics\_Comparator;

class ArrayComparator extends AbstractComparator
{

	private $fields = [];

	/**
	 * ArrayComperator constructor.
	 * @param array $fields
	 */
	public function __construct(array $fields)
	{
		$this->fields = $fields;
	}


	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b)
	{
		$cmp = 0;
		foreach ($this->fields as $key => $value) {
			if (is_int($key)) {
				//comp asc
				$cmp = $this->_comp($a, $b, $value);
			} else if (is_string($key)) {
				if (is_string($value)) {
					if (strtolower($value) === 'desc'
					) {
						$cmp = $this->_compDesc($a, $b, $key);
					} else if (strtolower($value) === 'asc'
					) {
						$cmp = $this->_comp($a, $b, $key);
					} else {
						$cmp = $this->_comp($a, $b, $key,$value);
					}
				} else {
					$cmp = $this->_comp($a, $b, $key, $value);
				}
			}
			if ($cmp != 0) {
				return $cmp;
			}
		}
		return $cmp;
	}

	private function _comp($a, $b, $field, $func = null)
	{
		$res = 0;
		if ($func != null) {
			if ($func instanceof ComparatorInterface) {
				$res = $func->compare($a[$field], $b[$field]);
			} else if (is_callable($func)) {
				$res = $func($a[$field], $b[$field]);
			} else {
				throw new InvalidArgumentException('invalid func');
			}
		} else {
			if (is_numeric($a[$field])) {
				$cmp = _Comparator::numeric();
				$res = $cmp->compare($a[$field], $b[$field]);
			} else {
				$cmp = _Comparator::alphaNumeric();
				$res = $cmp->compare($a[$field], $b[$field]);
			}
		}
		return $res;
	}

	private function _compDesc($a, $b, $field)
	{
		return -$this->_comp($a, $b, $field);
	}
}