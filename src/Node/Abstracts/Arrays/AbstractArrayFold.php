<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 07:19
 */

namespace Hurl\Node\Abstracts\Arrays;


use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Interfaces\ArrayTraitInterface;

abstract class AbstractArrayFold extends AbstractArray implements ArrayTraitInterface
{
	/**
	 * @var callable
	 */
	private $callable;
	/**
	 * @var
	 */
	private $init;

	/**
	 *  constructor.
	 * @param $callable
	 * @param $init
	 */
	public function __construct(callable $callable, $init)
	{
		$this->callable = $callable;
		$this->init = $init;
	}

	public function apply(...$data)
	{
		return array_reduce($data[0], $this->callable, $this->init);

	}
}
