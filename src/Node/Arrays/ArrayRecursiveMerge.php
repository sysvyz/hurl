<?php
namespace Hurl\Node\Arrays;


use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Interfaces\Traits\ArrayTraitInterface;
use Hurl\Node\Traits\ArrayTrait;

class ArrayRecursiveMerge extends AbstractArray implements ArrayTraitInterface
{
    use ArrayTrait;

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