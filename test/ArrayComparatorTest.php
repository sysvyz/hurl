<?php

namespace HurlTest;

use Hurl\Node\Comparator\ArrayComparator;
use Hurl\Node\Statics\Arrays;
use Hurl\Node\Statics\Comparators;

use Cofi\Exceptions\InvalidComparatorArgumentException;
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 17.07.16
 * Time: 13:59
 */
class ArrayComparatorTest extends \PHPUnit_Framework_TestCase
{

    public function testComparator()
    {
        $cmp = ArrayComparator::init([
            'score' => 'desc',
            'first_name' => Comparators::alphaNumeric(),
            'id',
        ]);

        $data = [
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 5
            ],
            [
                'score' => 56,
                'first_name' => 'dsf',
                'id' => 3
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 1
            ],
            [
                'score' => 99,
                'first_name' => 'fgh',
                'id' => 2
            ],
            [
                'score' => 99,
                'first_name' => 'xxx',
                'id' => 4
            ]

        ];
        $result = [
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 1
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 5
            ],
            [
                'score' => 99,
                'first_name' => 'fgh',
                'id' => 2
            ],
            [
                'score' => 99,
                'first_name' => 'xxx',
                'id' => 4
            ],
            [
                'score' => '56',
                'first_name' => 'dsf',
                'id' => 3
            ]

        ];

        $sort = Arrays::sort($cmp);
        $this->assertEquals($result, $sort($data));

    }

    public function testComparator2()
    {
        $cmp = new ArrayComparator([
            'score' => function ($a, $b) {
                return $b - $a;
            },
            'first_name' => 'strcmp',
            'id',
        ]);

        $data = [
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 5
            ],
            [
                'score' => 56,
                'first_name' => 'dsf',
                'id' => 3
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 1
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 1
            ],
            [
                'score' => 99,
                'first_name' => 'fgh',
                'id' => 2
            ],
            [
                'score' => 99,
                'first_name' => 'xxx',
                'id' => 4
            ]

        ];
        $result = [
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 1
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 1
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 5
            ],
            [
                'score' => 99,
                'first_name' => 'fgh',
                'id' => 2
            ],
            [
                'score' => 99,
                'first_name' => 'xxx',
                'id' => 4
            ],
            [
                'score' => '56',
                'first_name' => 'dsf',
                'id' => 3
            ]

        ];

        $sort = Arrays::sort($cmp);
        $this->assertEquals($result, $sort($data));

    }

    public function testComparator3()
    {
        $cmp = new ArrayComparator([
            'score' => function ($a, $b) {
                return $b - $a;
            },
            'first_name',
            'id' => 'asc',
        ]);

        $data = [
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 5
            ],
            [
                'score' => 56,
                'first_name' => 'dsf',
                'id' => 3
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 1
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 3
            ],
            [
                'score' => 99,
                'first_name' => 'fgh',
                'id' => 2
            ],
            [
                'score' => 99,
                'first_name' => 'xxx',
                'id' => 4
            ]

        ];
        $result = [
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 1
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 3
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 5
            ],
            [
                'score' => 99,
                'first_name' => 'fgh',
                'id' => 2
            ],
            [
                'score' => 99,
                'first_name' => 'xxx',
                'id' => 4
            ],
            [
                'score' => '56',
                'first_name' => 'dsf',
                'id' => 3
            ]

        ];

        $sort = Arrays::sort($cmp);
        $this->assertEquals($result, $sort($data));

    }

    public function testComparatorInvert()
    {
        $cmp = ArrayComparator::init([
            'score' => function ($a, $b) {
                return $b - $a;
            },
            'first_name',
            'id' => 'asc',
        ])->invert();

        $data = [
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 5
            ],
            [
                'score' => 56,
                'first_name' => 'dsf',
                'id' => 3
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 1
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 3
            ],
            [
                'score' => 99,
                'first_name' => 'fgh',
                'id' => 2
            ],
            [
                'score' => 99,
                'first_name' => 'xxx',
                'id' => 4
            ]

        ];
        $result = [
            [
                'score' => '56',
                'first_name' => 'dsf',
                'id' => 3
            ],
            [
                'score' => 99,
                'first_name' => 'xxx',
                'id' => 4
            ],
            [
                'score' => 99,
                'first_name' => 'fgh',
                'id' => 2
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 5
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 3
            ],
            [
                'score' => 99,
                'first_name' => 'asc',
                'id' => 1
            ]

        ];

        $sort = Arrays::sort($cmp);
        $this->assertEquals($result, $sort($data));

    }

    public function testComparatorMap()
    {
        $cmp = ArrayComparator::init([
            'score' => function ($a, $b) {
                return $b - $a;
            },
            'first_name',
            'id' => 'asc',
        ])->map(function ($elem) {
            return $elem['item'];
        });

        $data = [
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'asc',
                    'id' => 5
                ]
            ],
            [
                'item' => [
                    'score' => 56,
                    'first_name' => 'dsf',
                    'id' => 3
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'asc',
                    'id' => 1
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'asc',
                    'id' => 3
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'fgh',
                    'id' => 2
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'xxx',
                    'id' => 4
                ]
            ]

        ];
        $result = [
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'asc',
                    'id' => 1
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'asc',
                    'id' => 3
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'asc',
                    'id' => 5
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'fgh',
                    'id' => 2
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'xxx',
                    'id' => 4

                ]
            ],
            [
                'item' => [
                    'score' => 56,
                    'first_name' => 'dsf',
                    'id' => 3
                ]
            ]

        ];

        $sort = Arrays::sort($cmp);
        $this->assertEquals($result, $sort($data));

    }

    public function testComparatorRecursive()
    {
        $cmp = ArrayComparator::init([
            'item' => ArrayComparator::init([
                'score' => function ($a, $b) {
                    return $b - $a;
                },
                'first_name',
                'id' => 'asc',
            ])
        ]);

        $data = [
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'asc',
                    'id' => 5
                ]
            ],
            [
                'item' => [
                    'score' => 56,
                    'first_name' => 'dsf',
                    'id' => 3
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'asc',
                    'id' => 1
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'asc',
                    'id' => 3
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'fgh',
                    'id' => 2
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'xxx',
                    'id' => 4
                ]
            ]

        ];
        $result = [
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'asc',
                    'id' => 1
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'asc',
                    'id' => 3
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'asc',
                    'id' => 5
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'fgh',
                    'id' => 2
                ]
            ],
            [
                'item' => [
                    'score' => 99,
                    'first_name' => 'xxx',
                    'id' => 4

                ]
            ],
            [
                'item' => [
                    'score' => 56,
                    'first_name' => 'dsf',
                    'id' => 3
                ]
            ]

        ];

        $sort = Arrays::sort($cmp);
        $this->assertEquals($result, $sort($data));

    }

	/**
	 * @expectedException   	\Cofi\Exceptions\InvalidComparatorArgumentException
	 * @expectedExceptionCode 	1
	 */
	public function testComparatorFail()
	{
		$cmp = new ArrayComparator([
			'score' => 'asdfsfdljk',
			'id' => 'asc',
		]);

        $data = [
            ['score' => 99, 'id' => 5],
            ['score' => 56, 'id' => 3],
        ];
        $sort = Arrays::sort($cmp);
        $sort($data);

    }

	/**
	 * @expectedException       \Cofi\Exceptions\InvalidComparatorArgumentException
	 * @expectedExceptionCode  4

     */
    public function testComparatorFail2()
    {
        $cmp = new ArrayComparator([
            'someKey',
            'id',
        ]);

        $data = [
            ['score' => 99, 'id' => 5],
            ['score' => 56, 'id' => 3],
        ];
        $sort = Arrays::sort($cmp);
        $sort($data);

    }

	/**
	 * @expectedException       \Cofi\Exceptions\InvalidComparatorArgumentException
	 * @expectedExceptionCode  4
     */
    public function testComparatorFail3()
    {
        $cmp = new ArrayComparator([
            'someKey',
            'id',
        ]);

        $data = [
            ['someKey' => 99, 'id' => 5],
            ['score' => 56, 'id' => 3],
        ];
        $sort = Arrays::sort($cmp);
        $sort($data);

    }

	/**
	 * @expectedException       \Cofi\Exceptions\InvalidComparatorArgumentException
	 * @expectedExceptionCode  4
     */
    public function testComparatorFail4()
    {
        $cmp = new ArrayComparator([
            'someKey',
            'id',
        ]);

        $data = [
            ['score' => 56, 'id' => 3],
            ['someKey' => 99, 'id' => 5],
        ];
        $sort = Arrays::sort($cmp);
        $sort($data);

    }

	/**
	 * @expectedException       \Cofi\Exceptions\InvalidComparatorArgumentException
	 * @expectedExceptionCode  5
     */
    public function testComparatorFail5()
    {
        $cmp = new ArrayComparator([
            'score',
            'id',
        ]);

        $data = [
            ['score' => ['asa'], 'id' => 5],
            ['score' => ['assa'], 'id' => 3],
        ];
        $sort = Arrays::sort($cmp);
        $sort($data);

    }
}

