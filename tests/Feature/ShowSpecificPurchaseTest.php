<?php

namespace Tests\Feature;

use App\Constants\ElectronicTypes;
use Tests\TestCase;

class ShowSpecificPurchaseTest extends TestCase
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
    public function itGetSpecificItemWithPrice()
    {
        $response = $this->getJson(route(
            self::ROUTE,
            [
                'scenario' => 'default',
                'filter' => [
                    'type' => ElectronicTypes::ELECTRONIC_ITEM_CONSOLE,
                ],
            ]
        ));

        $response->assertExactJson([
            'total_price' => 567.28,
            'items' => [
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
            ],
        ]);
    }
}
