<?php
namespace Hurl\Node\Abstracts\Arrays;


use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Interfaces\ArrayTraitInterface;

abstract class ArrayRecursiveMerge extends AbstractArray implements ArrayTraitInterface
{

	private function _mergeRecursive(...$data)
	{
		$r = array_map(function ($elem) {
			if (is_array($elem)) {
				return $this->_mergeRecursive(... $elem);
			}
			return [$elem];
		}, $data);
		return array_merge(...$r);
	}

	public function apply(...$data)
	{
		return $this->_mergeRecursive(...$data);
	}
}