<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 07:19
 */

namespace Hurl\Node\Abstracts\Arrays;


use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Interfaces\ArrayTraitInterface;

abstract class ArrayMerge extends AbstractArray implements ArrayTraitInterface
{
	public function apply(...$data)
	{
		return array_merge(...$data);
	}
}