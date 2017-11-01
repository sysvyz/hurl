<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 06:23
 */

namespace Hurl\Node\Filters\Logic;


use Hurl\Node\Interfaces\Traits\FilterContainerTraitInterface;

abstract class LogicContainerFilterNode extends LogicFilter implements FilterContainerTraitInterface
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