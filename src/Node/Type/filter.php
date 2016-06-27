<?php

namespace Type;

use Hurl\Node\Abstracts\AbstractFilterNode;

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

interface FilterTraitInterface
{
	public function apply($value);
}

trait FilterTrait
{
	protected $value;

	abstract public function apply($value);

	public function __invoke(...$data)
	{
		return $this->apply($data[0]);
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
		return new class($this->value) extends AbstractGreaterThanFilter implements ComparatorFilterTraitInterface
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
	public function apply($value)
	{
		return is_string($value);
	}
}

abstract class AbstractIsNumericFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_numeric($value);
	}
}

abstract class AbstractIsIntegerFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_int($value);
	}
}

abstract class AbstractIsArrayFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_array($value);
	}
}

abstract class AbstractIsEmptyFilter extends AbstractFilterNode
{

	public function apply($value)

	{
		if (is_string($value)) {
			return strlen($value) == 0;
		}
		if (is_array($value)) {
			return empty($value);
		}
		if (is_null($value)) {
			return true;
		}
		return false;
	}
}

abstract class AbstractIsEvenFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_numeric($value) && $value % 2 == 0;
	}

	public function not()
	{
		return new class() extends AbstractIsOddFilter implements FilterTraitInterface
		{
			use FilterTrait;

		};
	}
}

abstract class AbstractIsOddFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_numeric($value) && $value % 2 != 0;
	}

	public function not()
	{
		return new class() extends AbstractIsEvenFilter implements FilterTraitInterface
		{
			use FilterTrait;

		};
	}
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