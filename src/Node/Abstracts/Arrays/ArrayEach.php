<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 07:21
 */

namespace Hurl\Node\Abstracts\Arrays;


use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Interfaces\ArrayTraitInterface;

abstract class ArrayEach extends AbstractArray implements ArrayTraitInterface
{
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