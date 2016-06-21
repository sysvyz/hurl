<?php
namespace Hurl\Node;
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 03:30
 */
class NodeContainer extends AbstractNode
{
    /**
     * @var callable
     */
    private $before;
    /**
     * @var callable
     */
    private $after;


    /**
     * NodeContainer constructor.
     * @param callable $before
     * @param callable $after
     */
    public function __construct(callable $before,callable $after)
    {
        $this->before = $before;
        $this->after = $after;
    }

    public function __invoke(...$args)
    {
        $before = $this->before;
        $after = $this->after;


        return $after($before(...$args));
    }

  
}