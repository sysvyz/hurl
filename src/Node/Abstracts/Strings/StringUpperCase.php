<?php

namespace Hurl\Node\Abstracts\Strings;


use Hurl\Node\Abstracts\AbstractStringNode;

class StringUpperCase extends AbstractStringNode
{
	public function __invoke(...$data)
	{
		return strtoupper($data[0]);
	}
}