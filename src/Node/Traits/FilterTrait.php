<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 04:28
 */

namespace Hurl\Node\Traits;


trait FilterTrait
{

	abstract public function apply($value);

	public function __invoke(...$data)
	{
		return $this->apply($data[0]);
	}
}