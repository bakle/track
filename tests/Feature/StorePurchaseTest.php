<?php

namespace Tests\Feature;

use App\Constants\ElectronicTypes;
use Tests\TestCase;

class StorePurchaseTest extends TestCase
{
    private const ROUTE = 'purchases.store';
    private array $purchaseInfo;

    /**
     * @test
     */
    public function itGetsCorrectResponseStructure(): void
    {
        $this->readScenario('successful_scenario');

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
        $this->readScenario('successful_scenario');

        $response = $this->postJson(route(self::ROUTE), $this->purchaseInfo);

        $response->assertJsonFragment([
            'total_price' => 4061.25,
        ]);
    }

    /**
     * @test
     */
    public function itGetsSortedItemsByPriceFromLowerToHighest(): void
    {
        $this->readScenario('successful_scenario');

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
        $this->readScenario('many_extras_scenario');

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

    private function readScenario(string $fileName): void
    {
        $this->purchaseInfo = json_decode(
            file_get_contents(__DIR__ . '/../Stubs/' . $fileName . '.json'),
            true
        );
    }
}
