<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 04:28
 */

namespace Hurl\Node\Traits;


trait FilterContainerTrait
{

	abstract public function fold($value);

	public function __invoke(...$data)
	{
		return $this->fold($data[0]);
	}
}