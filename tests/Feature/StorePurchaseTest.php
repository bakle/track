<?php

namespace Tests\Feature;

use App\Constants\ElectronicTypes;
use Tests\TestCase;

class StorePurchaseTest extends TestCase
{
    private const ROUTE = 'purchases.store';
    private array $purchaseInfo;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->purchaseInfo = json_decode(
            file_get_contents(__DIR__ . '/../Stubs/successful_scenario.json'),
            true
        );
    }

    /**
     * @test
     */
    public function itGetsCorrectResponseStructure(): void
    {
        $response = $this->postJson(route(self::ROUTE), $this->purchaseInfo);

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
        $response = $this->postJson(route(self::ROUTE), $this->purchaseInfo);

        $response->assertJson([
            'total_price' => 4061.25,
        ]);
    }

    /**
     * @test
     */
    public function itGetsSortedItemsByPriceFromLowerToHighest(): void
    {
        $response = $this->postJson(route(self::ROUTE), $this->purchaseInfo);

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
                            'price' => 10.99,
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
                            'price' => 10.99,
                            'is_wired' => false,
                        ],
                    ],
                ],
            ],
        ]);
    }
}
