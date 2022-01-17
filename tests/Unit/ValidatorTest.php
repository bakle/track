<?php

namespace Tests\Unit;

use App\Domains\Purchase\Validators\PurchaseValidator;
use Illuminate\Validation\ValidationException;
use Tests\DataProviders\WrongPurchaseDataProvider;
use Tests\TestCase;

class ValidatorTest extends TestCase
{
    use WrongPurchaseDataProvider;

    /**
     * @test
     * @dataProvider dataProvider
     */
    public function itValidatesCorrectlyEachField($data, $field)
    {
        try {
            PurchaseValidator::validate($data);
        } catch (ValidationException $exception) {
            $expectedField = array_key_first($exception->errors());
            $this->assertEquals($expectedField, $field);
        }
    }
}
