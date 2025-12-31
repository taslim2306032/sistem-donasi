<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BankAccount;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BankAccount::create([
            'bank_name' => 'BCA',
            'account_number' => '1483077223',
            'account_holder' => 'Taslim Nuralim',
            'is_active' => true,
        ]);

        BankAccount::create([
            'bank_name' => 'SeaBank',
            'account_number' => '901021781660',
            'account_holder' => 'Taslim Nuralim',
            'is_active' => true,
        ]);

        BankAccount::create([
            'bank_name' => 'BCA',
            'account_number' => '148373863998',
            'account_holder' => 'Muhamad Anwar Sanusi',
            'is_active' => true,
        ]);
    }
}
