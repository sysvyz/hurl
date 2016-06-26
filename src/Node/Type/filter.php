<?php

namespace Type;

use Hurl\Node\Abstracts\AbstractFilterNode;
use Hurl\Node\Container\ContainerTrait;
use Hurl\Node\Container\ContainerTraitInterface;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 22:25
 */
interface ComparatorFilterTraitInterface
{
	public function compare($that, $other);
}

trait ComparatorFilterTrait
{
	protected $value;

	abstract public function compare($that, $other);

	public function __invoke(...$data)
	{
		return $this->compare($this->value, $data[0]);
	}
}

abstract class AbstractComparatorFilter extends AbstractFilterNode
{
	protected $value;

	/**
	 *  constructor.
	 * @param $value
	 */
	public function __construct($value)
	{
		$this->value = $value;
	}

}

abstract class AbstractGreaterOrEqualFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return is_numeric($other) && $other >= $that;
	}

	public function not()
	{
		return new class($this->value) extends AbstractLessThanFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}

abstract class AbstractGreaterThanFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return is_numeric($other) && $other > $that;
	}

	public function not()
	{
		return new class($this->value) extends AbstractLessOrEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}

abstract class AbstractLessOrEqualFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return is_numeric($other) && $other <= $that;
	}

	public function not()
	{
		return new class($this->value) extends  AbstractGreaterThanFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}

abstract class AbstractLessThanFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return is_numeric($other) && $other < $that;
	}

	public function not()
	{
		return new class($this->value) extends AbstractGreaterOrEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}

abstract class AbstractIsEqualFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return $other == $that;
	}

	public function not()
	{
		return new class($this->value) extends AbstractIsNotEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}

abstract class AbstractIsNotEqualFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return $other != $that;
	}

	public function not()
	{
		return new class($this->value) extends AbstractIsEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}

abstract class AbstractIsStringFilter extends AbstractFilterNode
{
}

abstract class AbstractIsNumericFilter extends AbstractFilterNode
{
}

abstract class AbstractIsIntegerFilter extends AbstractFilterNode
{
}

abstract class AbstractIsArrayFilter extends AbstractFilterNode
{
}

abstract class AbstractIsEmptyFilter extends AbstractFilterNode
{
}

abstract class AbstractIsEvenFilter extends AbstractFilterNode
{
}

abstract class AbstractIsOddFilter extends AbstractFilterNode
{
}


abstract class AbstractLogicFilterNode extends AbstractFilterNode
{
}

abstract class AbstractNegatedFilter extends AbstractLogicFilterNode
{
}

abstract class AbstractAndFilter extends AbstractLogicFilterNode
{
}

abstract class AbstractOrFilter extends AbstractLogicFilterNode
{
}