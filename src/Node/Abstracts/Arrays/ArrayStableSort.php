<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 07:18
 */

namespace Hurl\Node\Abstracts\Arrays;

use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Abstracts\AbstractComparator;
use Hurl\Node\Abstracts\Comparator\GenericComparator;
use Hurl\Node\Interfaces\ArrayTraitInterface;
use Hurl\Node\Traits\ComparatorContainerTrait;

abstract class ArrayStableSort extends AbstractArray implements ArrayTraitInterface
{
	/**
	 * @var callable
	 */
	private $callable;

	/**
	 *  constructor.
	 * @param $callable
	 */
	public function __construct(callable ...$callables)
	{
		$callable = new GenericComparator($callables[0]);
		if (count($callables) > 1) {
			for ($int = 1; $int < count($callables); $int++) {



				$callable = new class($callable, new GenericComparator($callables[$int])) extends AbstractComparator
				{
					use ComparatorContainerTrait;
				};
			}
		}
		$this->callable = $callable;

	}

	public function apply(...$data)
	{
		$arr = [];
		$pos = 0;
		$cmp = $this->callable;
		foreach ($data[0] as $key => $value) {
			$arr [] = ['pos' => $pos++, 'key' => $key, 'value' => $value];
		}

		usort($arr, function ($a, $b) use ($cmp) {
			$val = $cmp($a['value'], $b['value']);
			if ($val) {
				return $val;
			}
			return $a['pos'] - $b['pos'];

		});
		$res = [];
		foreach ($arr as $key => $value) {
			$res[$value['key']] = $value['value'];
		}
		return $res;
	}


}