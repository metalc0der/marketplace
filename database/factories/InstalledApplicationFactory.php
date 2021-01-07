<?php

namespace Metalc0der\Marketplace\Database\Factories;

use Metalc0der\Marketplace\Models\InstalledApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstalledApplicationFactory extends Factory
{
    protected $model = InstalledApplication::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'application_id' => $this->faker->word(),
            'active' => 0
        ];
    }
}