<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilRelationsSeeder extends Seeder
{
    protected $tableName = "family_relations";
    protected $relations = [
        'Brother',
        'Sister',
        'Son',
        'Daughter',
        'Other',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->relations as $relation) {
            DB::table($this->tableName)->insert([
                'title' => $relation,
                'status' => true
            ]);
        }
    }
}
