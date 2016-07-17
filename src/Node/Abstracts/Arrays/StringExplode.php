<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 07:21
 */

namespace Hurl\Node\Abstracts\Arrays;


use Hurl\Node\Abstracts\AbstractArray;

abstract class StringExplode extends AbstractArray
{
	private $delimiter;

	public function __construct($delimiter)
	{
		$this->delimiter = $delimiter;
	}

	public function __invoke(...$data)
	{
		return explode($this->delimiter, $data[0]);

	}

}