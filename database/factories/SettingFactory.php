<?php

namespace Metalc0der\Marketplace\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Metalc0der\Marketplace\Models\Setting;

class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'key' => $this->faker->word(),
            'value' => $this->faker->word(),
            'seteable_id' => $this->faker->uuid(),
            'seteable_type' => User::class,
            'application_id' => $this->faker->uuid()
        ];
    }
}