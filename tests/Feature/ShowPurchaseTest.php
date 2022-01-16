<?php

namespace Tests\Feature;

use App\Constants\ElectronicTypes;
use Tests\TestCase;

class ShowPurchaseTest extends TestCase
{
    private const ROUTE = 'purchases.show';

    /**
     * @test
     */
    public function itGetsCorrectResponseStructure(): void
    {
        $response = $this->getJson(route(self::ROUTE, ['scenario' => 'default']));

        $response->assertJsonStructure([
            'total_price',
            'items' => [
                '*' => [
                    'type',
                    'price',
                    'is_wired',
                ],
            ],
        ]);
    }

    /**
     * @test
     */
    public function itGetsTotalPricing(): void
    {
        $response = $this->getJson(route(self::ROUTE, ['scenario' => 'default']));

        $response->assertJsonFragment([
            'total_price' => 4069.87,
        ]);
    }

    /**
     * @test
     */
    public function itGetsSortedItemsByPriceFromLowerToHighest(): void
    {
        $response = $this->getJson(route(self::ROUTE, ['scenario' => 'default']));

        $response->assertJsonFragment([
            'items' => [
                [
                    'type' => ElectronicTypes::ELECTRONIC_ITEM_MICROWAVE,
                    'price' => 350.5,
                    'is_wired' => false,
                ],
                [
                    'type' => ElectronicTypes::ELECTRONIC_ITEM_CONSOLE,
                    'price' => 540.99,
                    'is_wired' => false,
                    'extras' => [
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 10.99,
                            'is_wired' => true,
                        ],
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 15.3,
                            'is_wired' => false,
                        ],
                    ],
                ],
                [
                    'type' => ElectronicTypes::ELECTRONIC_ITEM_TELEVISION,
                    'price' => 980.99,
                    'is_wired' => false,
                    'extras' => [
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 15.30,
                            'is_wired' => false,
                        ],
                    ],
                ],
                [
                    'type' => ElectronicTypes::ELECTRONIC_ITEM_TELEVISION,
                    'price' => 2140.5,
                    'is_wired' => false,
                    'extras' => [
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 15.30,
                            'is_wired' => false,
                        ],
                    ],
                ],
            ],
        ]);
    }

    /**
     * @test
     */
    public function itDoesNotInsertTooManyExtras(): void
    {
        $response = $this->getJson(route(self::ROUTE, ['scenario' => 'many_extras']));

        $response->assertJsonFragment([
            'total_price' => 4148.74,
            'items' => [
                [
                    'type' => ElectronicTypes::ELECTRONIC_ITEM_MICROWAVE,
                    'price' => 350.5,
                    'is_wired' => false,
                ],
                [
                    'type' => ElectronicTypes::ELECTRONIC_ITEM_CONSOLE,
                    'price' => 540.99,
                    'is_wired' => false,
                    'extras' => [
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 10.99,
                            'is_wired' => true,
                        ],
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 15.3,
                            'is_wired' => false,
                        ],
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 10.99,
                            'is_wired' => true,
                        ],
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 15.3,
                            'is_wired' => false,
                        ],
                    ],
                ],
                [
                    'type' => ElectronicTypes::ELECTRONIC_ITEM_TELEVISION,
                    'price' => 980.99,
                    'is_wired' => false,
                    'extras' => [
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 15.3,
                            'is_wired' => false,
                        ],
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 10.99,
                            'is_wired' => true,
                        ],
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 15.3,
                            'is_wired' => false,
                        ],
                    ],
                ],
                [
                    'type' => ElectronicTypes::ELECTRONIC_ITEM_TELEVISION,
                    'price' => 2140.5,
                    'is_wired' => false,
                    'extras' => [
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 15.3,
                            'is_wired' => false,
                        ],
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 10.99,
                            'is_wired' => true,
                        ],
                        [
                            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
                            'price' => 15.3,
                            'is_wired' => false,
                        ],
                    ],
                ],
            ],
        ]);
    }
}
