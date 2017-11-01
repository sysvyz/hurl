<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:34
 */

namespace Hurl\Node\Statics;


use Hurl\Node\Abstracts\AbstractFilter;
use Hurl\Node\Filters\Comparator\GreaterOrEqualFilter;
use Hurl\Node\Filters\Comparator\GreaterThanFilter;
use Hurl\Node\Filters\Comparator\IsEqualFilter;
use Hurl\Node\Filters\Comparator\IsNotEqualFilter;
use Hurl\Node\Filters\Comparator\LessOrEqualFilter;
use Hurl\Node\Filters\Comparator\LessThanFilter;
use Hurl\Node\Filters\ContainsFilter;
use Hurl\Node\Filters\IsArrayFilter;
use Hurl\Node\Filters\IsEmptyFilter;
use Hurl\Node\Filters\IsStringFilter;
use Hurl\Node\Filters\Logic\AndFilter;
use Hurl\Node\Filters\Logic\OrFilter;
use Hurl\Node\Filters\Number\IsEvenFilter;
use Hurl\Node\Filters\Number\IsIntegerFilter;
use Hurl\Node\Filters\Number\IsNumericFilter;
use Hurl\Node\Filters\Number\IsOddFilter;
use Hurl\Node\Interfaces\Traits\ComparatorFilterTraitInterface;
use Hurl\Node\Interfaces\Traits\FilterTraitInterface;
use Hurl\Node\Traits\ComparatorFilterTrait;
use Hurl\Node\Traits\FilterContainerTrait;
use Hurl\Node\Traits\FilterTrait;


final class Filters
{
    /**
     * _Filter constructor.
     * @codeCoverageIgnore
     */
    private final function __construct()
    {
    }

    /**
     * @return IsEmptyFilter
     */
    public static function isEmpty()
    {
        return new class() extends IsEmptyFilter implements FilterTraitInterface
        {
            use FilterTrait;
        };
    }

    public static function contains($needle, $strict = null)
    {
        return new class($needle, $strict) extends ContainsFilter
        {
            use FilterTrait;
        };
    }

    /**
     * @return IsNumericFilter
     */
    public static function isNumeric()
    {
        return new class() extends IsNumericFilter implements FilterTraitInterface
        {
            use FilterTrait;
        };
    }

    /**
     * @return IsIntegerFilter
     */
    public static function isInt()
    {
        return new class() extends IsIntegerFilter implements FilterTraitInterface
        {
            use FilterTrait;
        };
    }

    /**
     * @return IsStringFilter
     */
    public static function isString()
    {
        return new class() extends IsStringFilter implements FilterTraitInterface
        {
            use FilterTrait;
        };
    }

    /**
     * @return IsArrayFilter
     */
    public static function isArray()
    {
        return new class() extends IsArrayFilter implements FilterTraitInterface
        {
            use FilterTrait;
        };
    }

    /**
     * @return AndFilter
     */
    public static function and (...$filters)
    {
        return new class(...$filters) extends AndFilter
        {

            use FilterContainerTrait;

        };
    }

    /**
     * @return OrFilter
     */
    public static function or (...$filters)
    {
        return new class(...$filters) extends OrFilter
        {

            use FilterContainerTrait;
        };
    }

    /**
     * @return IsEvenFilter
     */
    public static function isEven()
    {
        return new class() extends IsEvenFilter implements FilterTraitInterface
        {
            use FilterTrait;
        };
    }

    /**
     * @return IsOddFilter
     */
    public static function isOdd()
    {
        return new class() extends IsOddFilter implements FilterTraitInterface
        {
            use FilterTrait;
        };
    }

    /**
     * @return GreaterThanFilter
     */
    public static function isGreaterThan($value)
    {
        return new class($value) extends GreaterThanFilter implements ComparatorFilterTraitInterface
        {
            use ComparatorFilterTrait;
        };
    }

    /**
     * @return LessThanFilter
     */
    public static function isLessThan($value)
    {
        return new class($value) extends LessThanFilter implements ComparatorFilterTraitInterface
        {
            use ComparatorFilterTrait;
        };
    }

    /**
     * @return GreaterOrEqualFilter
     */
    public static function isGreaterOrEqual($value)
    {
        return new class($value) extends GreaterOrEqualFilter implements ComparatorFilterTraitInterface
        {
            use ComparatorFilterTrait;
        };
    }

    /**
     * @return LessOrEqualFilter
     */
    public static function isLessOrEqual($value)
    {
        return new class($value) extends LessOrEqualFilter implements ComparatorFilterTraitInterface
        {
            use ComparatorFilterTrait;
        };
    }

    /**
     * @return IsEqualFilter
     */
    public static function isEqual($value)
    {
        return new class($value) extends IsEqualFilter implements ComparatorFilterTraitInterface
        {
            use ComparatorFilterTrait;
        };
    }

    /**
     * @return IsNotEqualFilter
     */
    public static function isNotEqual($value)
    {
        return new class($value) extends IsNotEqualFilter implements ComparatorFilterTraitInterface
        {
            use ComparatorFilterTrait;
        };
    }

    public static function init(callable $callable)
    {
        return new class($callable) extends AbstractFilter
        {
            private $callable;

            /**
             *  constructor.
             * @param $callable
             */
            public function __construct($callable)
            {
                $this->callable = $callable;
            }


            public function __invoke(... $args)
            {
                $f = $this->callable;
                return $f($args[0], $args[1]);
            }
        };
    }


}