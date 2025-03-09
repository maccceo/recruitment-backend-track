<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\TaxProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private Collection $users;
    private Collection $taxProfiles;
    private Collection $invoices;

    const USERS_TO_CREATE = 20;
    const MAX_TAX_PROFILES_PER_USER = 3;
    const MAX_INVOICES_PER_TAX_PROFILE = 5;

    public function __construct()
    {
        $this->users = new Collection();
        $this->taxProfiles = new Collection();
        $this->invoices = new Collection();
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedUsers();
        $this->seedTaxProfiles();
        $this->seedInvoices();
    }

    private function seedUsers(): void
    {
        $this->users = User::factory()->count(self::USERS_TO_CREATE)->create();
    }

    private function seedTaxProfiles(): void
    {
        $this->users->each(function ($user) {
            $this->taxProfiles = $this->taxProfiles->merge(
                TaxProfile::factory()
                    ->count(rand(1, self::MAX_TAX_PROFILES_PER_USER))
                    ->create([
                        'user_id' => $user->id
                    ])
            );
        });
    }

    private function seedInvoices(): void
    {
        $this->taxProfiles->each(function ($taxProfile) {
            $this->invoices = $this->invoices->merge(
                Invoice::factory()
                    ->count(rand(1, self::MAX_INVOICES_PER_TAX_PROFILE))
                    ->create([
                        'tax_profile_id' => $taxProfile->id
                    ])
            );
        });
    }
}
