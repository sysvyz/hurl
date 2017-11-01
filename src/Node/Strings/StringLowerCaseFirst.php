<?php

namespace Hurl\Node\Strings;


use Hurl\Node\Abstracts\AbstractStringNode;

class StringLowerCaseFirst extends AbstractStringNode
{
	public function __invoke(...$data)
	{
		return lcfirst($data[0]);
	}
}