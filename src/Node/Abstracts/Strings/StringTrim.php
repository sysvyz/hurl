<?php

namespace Hurl\Node\Abstracts\Strings;


use Hurl\Node\Abstracts\AbstractStringNode;

class StringTrim extends AbstractStringNode
{
	public function __invoke(...$data)
	{
		return trim($data[0]);
	}
}