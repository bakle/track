<?php

namespace Tests\DataProviders;

use App\Constants\ElectronicTypes;

trait WrongPurchaseDataProvider
{
    public function dataProvider(): array
    {
        return [
            'empty purchase' => [
                array_replace($this->data(), ['purchase' => []]),
                'purchase',
            ],
            'empty name' => [
                array_replace_recursive($this->data(), [
                    'purchase' => [
                        [
                            'name' => '',
                        ],
                    ],
                ]),
                'purchase.0.name',
            ],
            'not available name (electronic type' => [
                array_replace_recursive($this->data(), [
                    'purchase' => [
                        [
                            'name' => 'testing',
                        ],
                    ],
                ]),
                'purchase.0.name',
            ],
            'empty price' => [
                array_replace_recursive($this->data(), [
                    'purchase' => [
                        [
                            'price' => '',
                        ],
                    ],
                ]),
                'purchase.0.price',
            ],
            'negative price' => [
                array_replace_recursive($this->data(), [
                    'purchase' => [
                        [
                            'price' => -23.99,
                        ],
                    ],
                ]),
                'purchase.0.price',
            ],
            'not numeric price' => [
                array_replace_recursive($this->data(), [
                    'purchase' => [
                        [
                            'price' => 'testing price',
                        ],
                    ],
                ]),
                'purchase.0.price',
            ],
            'not array or null extras' => [
                array_replace_recursive($this->data(), [
                    'purchase' => [
                        [
                            'extras' => 'testing extra',
                        ],
                    ],
                ]),
                'purchase.0.extras',
            ],
            'empty extra name' => [
                array_replace_recursive($this->data(), [
                    'purchase' => [
                        [
                            'extras' => [
                                [
                                    'name' => '',
                                ],
                            ],
                        ],
                    ],
                ]),
                'purchase.0.extras.0.name',
            ],
            'empty extra price' => [
                array_replace_recursive($this->data(), [
                    'purchase' => [
                        [
                            'extras' => [
                                [
                                    'price' => '',
                                ],
                            ],
                        ],
                    ],
                ]),
                'purchase.0.extras.0.price',
            ],
            'negative extra price' => [
                array_replace_recursive($this->data(), [
                    'purchase' => [
                        [
                            'extras' => [
                                [
                                    'price' => -23.99,
                                ],
                            ],
                        ],
                    ],
                ]),
                'purchase.0.extras.0.price',
            ],
            'not number extra price' => [
                array_replace_recursive($this->data(), [
                    'purchase' => [
                        [
                            'extras' => [
                                [
                                    'price' => 'testing extra price',
                                ],
                            ],
                        ],
                    ],
                ]),
                'purchase.0.extras.0.price',
            ],
            'null extras attributes' => [
                array_replace_recursive($this->data(), [
                    'purchase' => [
                        [
                            'extras' => [
                                [
                                    'attributes' => null,
                                ],
                            ],
                        ],
                    ],
                ]),
                'purchase.0.extras.0.attributes',
            ],
            'empty extras wired attributes' => [
                array_replace_recursive($this->data(), [
                    'purchase' => [
                        [
                            'extras' => [
                                [
                                    'attributes' => [
                                        'wired' => '',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]),
                'purchase.0.extras.0.attributes.wired',
            ],
            'not boolean extras wired attributes' => [
                array_replace_recursive($this->data(), [
                    'purchase' => [
                        [
                            'extras' => [
                                [
                                    'attributes' => [
                                        'wired' => 'testing wired',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]),
                'purchase.0.extras.0.attributes.wired',
            ],
        ];
    }

    private function data(): array
    {
        return [
            'purchase' => [
                [
                    'name' => ElectronicTypes::ELECTRONIC_ITEM_CONSOLE,
                    'price' => 540.99,
                    'extras' => [
                        [
                            'name' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 10.99,
                            'attributes' => [
                                'wired' => true,
                            ],
                        ],
                    ],
                ],
            ],

        ];
    }
}
