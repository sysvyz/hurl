<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 23:37
 */

namespace Hurl\Node\Math;


use Hurl\Node\AbstractNode;
use Hurl\Node\ArrayNode;
use Hurl\Node\ComparatorNode;
use Hurl\Node\Node;

class MathNode
{

    /**
     * @param $delimiter
     * @return AbstractNode
     */
    public static function average()
    {
        return new class() extends AbstractNode
        {

            public function __construct()
            {

            }

            public function __invoke(...$data)
            {
                $arr = $data[0];

                $sum =  MathNode::sum();

                return $sum($arr)/count($arr);

            }
        };
    }
    /**
     * @param $delimiter
     * @return AbstractNode
     */
    public static function median()
    {
        return new class() extends AbstractNode
        {

            public function __construct()
            {

            }

            public function __invoke(...$data)
            {
                $sort = ArrayNode::sort(ComparatorNode::numeric());
                $arr = $sort($data[0]);
                $length = count($arr);


                if($length%2){
                        return $arr[(int)floor($length/2)];
                }
                return ($arr[(int)floor($length/2)]+$arr[(int)floor($length/2)-1])/2;

            }
        };
    }



    public static function sum()
    {
        return ArrayNode::fold(function ($a, $b) {
            return $a + $b;
        },0);
    }

    public static function product()
    {
        return ArrayNode::fold(function ($a, $b) {
            return $a * $b;
        },1);
    }
}