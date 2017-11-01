<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 17.07.16
 * Time: 20:04
 */

namespace Hurl\Node\Comparator;


use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Hurl\Node\Abstracts\AbstractComparator;
use Hurl\Node\Exceptions\UndefinedPropertyException;
use Hurl\Node\Interfaces\ComparatorInterface;
use Hurl\Node\Statics\Comparators;

abstract class AbstractContainerComparator extends AbstractComparator
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

	public static function init(array $fields)
	{
		return new static($fields);
	}

	/**
	 * @param $a
	 * @param $b
	 * @return int
	 * @throws UndefinedPropertyException
	 * @throws \InvalidArgumentException
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
						$cmp = $this->_comp($a, $b, $key, $value);
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

	/**
	 * @param $a
	 * @param $b
	 * @param $field
	 * @param null $func
	 * @return int
	 * @throws UndefinedPropertyException
	 * @throws \InvalidArgumentException
	 */
	private function _comp($a, $b, $field, $func = null)
	{

		if (!$this->_isset($a, $field) || !$this->_isset($b, $field)) {
			throw new UndefinedPropertyException('Undefined index: ' . $field);
		}

		$val1 = $this->_get($a, $field);
		$val2 = $this->_get($b, $field);
		$res = 0;
		if ($func != null) {
			if ($func instanceof ComparatorInterface) {
				$res = $func->compare($val1, $val2);
			} else if (is_callable($func)) {
				$res = $func($val1, $val2);
			} else {
				throw new InvalidArgumentException('invalid func');
			}
		} else {
			
			if (is_numeric($val1) || is_bool($val1)) {
				$cmp = Comparators::numeric();
				$res = $cmp->compare($val1, $val2);
			} else if (is_string($val1)) {
				$cmp = Comparators::alphaNumeric();
				$res = $cmp->compare($val1, $val2);
			} else {
				throw new InvalidArgumentException('invalid property');
			}
		}
		return $res;
	}

	private function _compDesc($a, $b, $field)
	{
		return -$this->_comp($a, $b, $field);
	}

	abstract protected function _isset(&$x, $field);

	abstract protected function _get(&$x, $field);
}