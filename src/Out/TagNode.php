<?php

namespace Hurl\Out;


use Hurl\Node\Abstracts\AbstractNode;

class TagNode
{


    public static function tag()
    {
        return new class() extends AbstractNode
        {

            private function renderTag($tag)
            {
                return $tag . "";
            }

            public function __invoke(...$data)
            {
                return implode('', array_map([$this, 'renderTag'], $data));
            }

        };

    }

    /**
     * @param array $attributes
     * @return AbstractNode
     */
    public static function attributes(array $attributes = [])
    {
        return new class() extends AbstractNode
        {

            public function __invoke(...$data)
            {
                $arr = [];
                foreach ($data[0] as $key => $value) {
                    $arr[] = ' ' . $key . '="' . $value . '"';
                }
                return implode('', $arr);

            }
        };

    }

    /**
     * @param string $name
     * @param array $attributes
     * @return AbstractNode
     */
    public static function element(string $name, array $attributes = [])
    {
        return new class($name, $attributes) extends AbstractNode
        {
            /**
             * @var string
             */
            private $name;
            /**
             * @var array
             */
            private $attributes;


            /**
             *  constructor.
             * @param string $name
             * @param array $attributes
             */
            public function __construct(string $name, array $attributes = [])
            {

                $this->name = $name;
                $this->attributes = $attributes;
            }

            /**
             * @param array ...$data
             * @return string
             */
            public function __invoke(...$data)
            {
                $attNode = TagNode::attributes();
                return "<" . $this->name . $attNode($this->attributes) . ">" . $data[0] . "</" . $this->name . ">";
            }
        };

    }


}