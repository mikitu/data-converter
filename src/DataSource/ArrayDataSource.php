<?php

namespace App\DataSource;

use App\Contract\DataSourceInterface;

class ArrayDataSource implements DataSourceInterface
{
    /**
     * @return array
     */
    public function getData()
    {
        return [
            'name' => 'account',
            'attr' => [
                'id' => 123456
            ],
            'children' => [
                [
                    'name' => 'name',
                    'attr' => [],
                    'children' => [
                        'BBC'
                    ]
                ],
                [
                    'name' => 'monitors',
                    'attr' => [],
                    'children' => [
                        [
                            'name' => 'monitor',
					        'attr' => [
                                'id' => 5235632,
                             ],
					        'children' => [
                                [
                                    'name' => 'url',
							        'attr' => [],
							        'children' => [
								        'http://www.bbc.co.uk/'
							        ]
						        ]
					        ]
				        ],
                        [
                            'name' => 'monitor',
                            'attr' => [
                                'id' => 5235633
                            ],
                            'children' => [
                                [
                                    'name' => 'url',
                                    'attr' => [],
                                    'children' => [
                                        'http://www.bbc.co.uk/news'
                                    ]
                                ]
                            ]
                        ],
                    ]
                ],
			]
		];
    }
}