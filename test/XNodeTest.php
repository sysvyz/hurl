<?php

namespace HurlTest;


use Hurl\Node\Statics\_Array;
use Hurl\Node\Statics\_Node;
use Hurl\Out\Tag;

class XNodeTest extends \PHPUnit_Framework_TestCase
{


	public function testXNode()
	{
		$data = ['abc', 'qwert', 'xyz'];


		$fn = _Node::init(function ($data) {
			$map = _Array::map(function ($value) {
				return Tag::init('li')->inner($value);
			});
			return Tag::init('ul')->inner($map($data));
		});

		$this->assertEquals('<ul><li>abc</li><li>qwert</li><li>xyz</li></ul>', $fn($data) . '');
	}
}

