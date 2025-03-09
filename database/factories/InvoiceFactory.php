<?php

namespace Database\Factories;

use App\Enums\Invoice\InvoiceStatusType;
use App\Models\TaxProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "tax_profile_id" => TaxProfile::factory(),
            "invoice_number" => $this->faker->unique()->word(),
            "issue_date" => $this->faker->dateTimeThisYear(),
            "due_date" => $this->faker->dateTimeInInterval('+1 day', '+30 days'),
            'total_amount' => $this->faker->randomFloat(2, 100, 5000),
            'status' => $this->faker->randomElement(array_column(InvoiceStatusType::cases(), 'value')),
        ];
    }
}
