<?php

namespace Database\Factories;

use App\Enums\TaxProfile\LegalEntityType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaxProfile>
 */
class TaxProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => User::factory(),
            "tax_code" => $this->faker->bothify('?????-#####'),
            "vat_number" => $this->faker->randomNumber(8, true),
            "legal_entity_type" => $this->faker->randomElement(array_column(LegalEntityType::cases(), 'value')),
        ];
    }
}
