<?php

namespace Hurl\Node\Strings;


use Hurl\Node\Abstracts\AbstractStringNode;

class StringLeftTrim extends AbstractStringNode
{
	public function __invoke(...$data)
	{
		return ltrim($data[0]);
	}
}