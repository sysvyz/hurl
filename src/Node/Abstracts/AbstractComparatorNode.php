<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 23:57
 */

namespace Hurl\Node\Abstracts;


use Hurl\Node\Interfaces\ComparatorInterface;
use Hurl\Node\Interfaces\ContainerTraitInterface;
use Hurl\Node\Traits\ComparatorContainerTrait;

abstract class AbstractComparatorNode extends AbstractNode implements ComparatorInterface
{

	private $isInvert = 1;
	/**
	 * @var callable
	 */
	private $callable = null;

	/**
	 * @param callable $do
	 * @return AbstractNode
	 */
	public function call(callable $do)
	{
		return new class($this, $do) extends AbstractComparatorNode implements ContainerTraitInterface
		{
			use ComparatorContainerTrait;

		};
	}


	/**
	 * @return AbstractComparatorNode
	 */

	public function invert()
	{

		return new class($this) extends AbstractComparatorNode
		{
			private $inner;

			/**
			 * ContainerNode constructor.
			 * @param ComparatorInterface $inner
			 */
			public function __construct(ComparatorInterface $inner)
			{
				$this->inner = $inner;
			}

			/**
			 * @param $a
			 * @param $b
			 * @return int
			 */
			public function compare($a, $b)
			{


				return -$this->inner->compare($a, $b);
			}
		};
	}

	/**
	 * @param callable $callable
	 * @return $this
	 */
	public function map(callable $map)
	{


		return new class($this, $map) extends AbstractComparatorNode
		{
			private $inner;
			/**
			 * @var callable
			 */
			private $map;

			/**
			 * ContainerNode constructor.
			 * @param ComparatorInterface $inner
			 * @param callable $map
			 */
			public function __construct(ComparatorInterface $inner, callable $map)
			{
				$this->inner = $inner;
				$this->map = $map;
			}

			/**
			 * @param $a
			 * @param $b
			 * @return int
			 */
			public function compare($a, $b)
			{


				$map = $this->map;
				return $this->inner->compare($map($a), $map($b));
			}
		};

	}

	public function __invoke(...$data)
	{

		return $this->compare($data[0], $data[1]);

	}
}