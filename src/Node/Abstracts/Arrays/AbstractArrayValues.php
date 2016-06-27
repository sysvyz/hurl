<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 07:20
 */

namespace Hurl\Node\Abstracts\Arrays;


use Hurl\Node\Abstracts\AbstractArrayNode;
use Hurl\Node\Interfaces\ArrayTraitInterface;

abstract class AbstractArrayValues extends AbstractArrayNode implements ArrayTraitInterface
{
	public function apply(...$data)
	{
		return array_merge(...$data);
	}

}