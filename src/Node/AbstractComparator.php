<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 23:57
 */

namespace Hurl\Node;


abstract class AbstractComparator extends AbstractNode implements ComparatorInterface
{


    private $isInvert = 1;

    /**
     * @return AbstractComparator
     */

    public function invert()
    {
        $this->isInvert *= -1;
        return $this;
    }

    public function __invoke(...$data)
    {
        return $this->isInvert * $this->compare($data[0], $data[1]);

    }
}