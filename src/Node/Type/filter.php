<?php

namespace Type;

use Hurl\Node\Abstracts\AbstractFilterNode;
use Hurl\Node\Abstracts\Filter\AbstractComparatorFilter;
use Hurl\Node\Interfaces\ComparatorFilterTraitInterface;
use Hurl\Node\Interfaces\FilterTraitInterface;
use Hurl\Node\Traits\ComparatorFilterTrait;
use Hurl\Node\Traits\FilterTrait;


abstract class GreaterOrEqualFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return is_numeric($other) && $other >= $that;
	}

	public function not()
	{
		return new class($this->value) extends LessThanFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}

abstract class GreaterThanFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return is_numeric($other) && $other > $that;
	}

	public function not()
	{
		return new class($this->value) extends LessOrEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}

abstract class LessOrEqualFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return is_numeric($other) && $other <= $that;
	}

	public function not()
	{
		return new class($this->value) extends GreaterThanFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}

abstract class LessThanFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return is_numeric($other) && $other < $that;
	}

	public function not()
	{
		return new class($this->value) extends GreaterOrEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}

abstract class IsEqualFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return $other == $that;
	}

	public function not()
	{
		return new class($this->value) extends IsNotEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}

abstract class IsNotEqualFilter extends AbstractComparatorFilter
{
	public function compare($that, $other)
	{
		return $other != $that;
	}

	public function not()
	{
		return new class($this->value) extends IsEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;

		};
	}
}

abstract class IsStringFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_string($value);
	}
}

abstract class IsNumericFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_numeric($value);
	}
}

abstract class IsIntegerFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_int($value);
	}
}

abstract class IsArrayFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_array($value);
	}
}

abstract class IsEmptyFilter extends AbstractFilterNode
{

	public function apply($value)

	{
		if (is_string($value)) {
			return strlen($value) == 0;
		}
		if (is_array($value)) {
			return empty($value);
		}
//		if (is_null($value)) { //TODO WHAT TODO?
//			return true;
//		}
		return false;
	}
}

abstract class IsEvenFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_numeric($value) && $value % 2 == 0;
	}

	public function not()
	{
		return new class() extends IsOddFilter implements FilterTraitInterface
		{
			use FilterTrait;

		};
	}
}

abstract class IsOddFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_numeric($value) && $value % 2 != 0;
	}

	public function not()
	{
		return new class() extends IsEvenFilter implements FilterTraitInterface
		{
			use FilterTrait;

		};
	}
}


abstract class LogicFilterNode extends AbstractFilterNode
{
}

abstract class NegatedFilter extends LogicFilterNode
{
}

abstract class AndFilter extends LogicFilterNode
{
}

abstract class OrFilter extends LogicFilterNode
{
}