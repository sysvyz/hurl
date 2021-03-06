<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:34
 */

namespace Hurl\Node\Statics;


use Hurl\Node\Abstracts\AbstractComparator;
use Hurl\Node\Comparator\BooleanComparator;
use Hurl\Node\Comparator\NumericComparator;
use Hurl\Node\Comparator\StringComparator;
use Hurl\Node\Comparator\StringLengthComparator;

abstract class Comparators
{
    /**
     * _Comparator constructor.
     * @codeCoverageIgnore
     */
    private final function __construct()
    {
    }

    /**
     * @return AbstractComparator
     */
    public static function numeric($delta = 0)
    {
        return new class($delta) extends NumericComparator
        {
        };
    }

    /**
     * @return StringComparator
     */
    public static function alphaNumeric()
    {
        return new class() extends StringComparator
        {
        };
    }

    /**
     * @return AbstractComparator
     */
    public static function stringLength()
    {
        return new class() extends StringLengthComparator
        {
        };
    }

    /**
     * @return AbstractComparator
     */
    public static function boolean()
    {
        return new class() extends BooleanComparator
        {
        };
    }

}
