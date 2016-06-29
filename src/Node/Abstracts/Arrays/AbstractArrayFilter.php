<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 07:20
 */

namespace Hurl\Node\Abstracts\Arrays;



use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Interfaces\ArrayTraitInterface;

abstract class AbstractArrayFilter extends AbstractArray implements ArrayTraitInterface
{	/**
 * @var callable
 */
	protected $callable;

	/**
	 *  constructor.
	 * @param $callable
	 */
	public function __construct(callable $callable = null)
	{
		$this->callable = $callable;
	}

	public function apply(...$data)
	{
//var_dump($this->callable);die;

		if ($this->callable) {
			return array_filter($data[0], $this->callable);
		}
		return array_filter($data[0]);
	}

}