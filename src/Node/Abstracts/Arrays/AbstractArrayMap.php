<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 07:18
 */

namespace Hurl\Node\Abstracts\Arrays;


use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Interfaces\ArrayTraitInterface;

abstract class AbstractArrayMap extends AbstractArray implements ArrayTraitInterface
{	protected $mapping;

	public function __construct($mapping)
	{
		$this->mapping = $mapping;
	}

	public function apply(...$data)
	{
		return array_map($this->mapping, ...$data);
	}
}