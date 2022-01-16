<?php

namespace App\Helpers;

class Scenario
{
    public static function getScenario(string $scenarioName): array
    {
        return json_decode(
            file_get_contents(app_path('Domains/Purchase/Scenarios/' . $scenarioName . '.json')),
            true
        );
    }
}
