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

class ArrayReduce extends AbstractArray implements ArrayTraitInterface
{
    use ArrayTrait;
	private $do;
	private $init;

	public function __construct($init,callable $do)
	{
		$this->do = $do;
		$this->init = $init;
	}

	public function apply(...$data)
	{
		return array_reduce($data[0], $this->do,$this->init);
	}
}