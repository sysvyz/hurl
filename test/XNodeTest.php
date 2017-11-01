<?php

namespace HurlTest;


use Hurl\Node\Statics\Arrays;
use Hurl\Node\Statics\Nodes;
use Hurl\Out\Tag;

class XNodeTest extends \PHPUnit_Framework_TestCase
{


	public function testXNode()
	{
		$data = ['abc', 'qwert', 'xyz'];


		$fn = Nodes::init(function ($data) {
			$map = Arrays::map(function ($value) {
				return Tag::init('li')->inner($value);
			});
			return Tag::ul($map($data),['class' => 'abc']);
		});

		$this->assertEquals('<ul class="abc"><li>abc</li><li>qwert</li><li>xyz</li></ul>', $fn($data) . '');
	}
}

