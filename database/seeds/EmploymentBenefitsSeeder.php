<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmploymentBenefitsSeeder extends Seeder
{

    protected $tableName = "employer_benefits_masters";
    protected $benefits = [
        'Health Insurance',
        'Dental Insurance',
        'Dependent Care Spending Account',
        'Healthcare Flexible Spending Account',
        'Life Insurance - Basic',
        'Life Insurance - Optional',
        'AD&D Insurance',
        'Depending Life Spouse Insurance',
        'Dependent Life Child Insurance',
        'Dependent Life Child Insurance',
        'Long-Term Disability Insurance',
        'Group Legal Benefit',
        'Group Auto/Home Insurance',
        'Pet Insurance',
        '401K or Other Retirement Savings plan via employer'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->benefits as $benefit) {
            DB::table($this->tableName)->insert([
                'title' => $benefit,
                'status' => true
            ]);
        }
    }
}
