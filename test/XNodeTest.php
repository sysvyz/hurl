<?php

namespace HurlTest;


use Hurl\Node\ArrayNode;
use Hurl\Node\Node;
use Hurl\Out\Tag;

class XNodeTest extends \PHPUnit_Framework_TestCase
{


	public function testXNode()
	{
		$data = ['abc', 'qwert', 'xyz'];


		$fn = Node::call(function ($data) {
			$map = ArrayNode::map(function ($value) {
				return Tag::init('li')->inner($value);
			});
			return Tag::init('ul')->inner($map($data));
		});

		$this->assertEquals('<ul><li>abc</li><li>qwert</li><li>xyz</li></ul>', $fn($data) . '');
	}
}

