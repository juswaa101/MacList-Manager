<?php

namespace Database\Factories;

use App\Enum\MacTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MacAddress>
 */
class MacAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mac_address' => $this->faker->macAddress(),
            'type' => $this->faker->randomElement(MacTypeEnum::values()),
            'description' => $this->faker->sentence(),
        ];
    }
}
