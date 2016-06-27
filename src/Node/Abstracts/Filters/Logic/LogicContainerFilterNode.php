<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 06:23
 */

namespace Hurl\Node\Abstracts\Filters\Logic;


use Hurl\Node\Interfaces\FilterContainerTraitInterface;

abstract class LogicContainerFilterNode extends LogicFilterNode implements FilterContainerTraitInterface
{
	/**
	 * @var callable[]
	 */
	protected $filters;

	/**
	 *  constructor.
	 * @param $filters
	 */
	public function __construct(callable ...$filters)
	{
		$this->filters = $filters;
	}

}