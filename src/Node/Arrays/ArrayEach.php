<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 07:21
 */

namespace Hurl\Node\Arrays;


use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Interfaces\Traits\ArrayTraitInterface;
use Hurl\Node\Traits\ArrayTrait;

class ArrayEach extends AbstractArray implements ArrayTraitInterface
{
    use ArrayTrait;
	private $do;

	public function __construct($do)
	{
		$this->do = $do;
	}

	public function apply(...$data)
	{
		array_walk($data[0], $this->do);
		return $data;
	}
}