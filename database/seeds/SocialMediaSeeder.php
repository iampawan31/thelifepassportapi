<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder
{
    protected $tableName = "social_media";
    protected $socialMediaOptions = [
        'Facebook',
        'Twitter',
        'Instagram',
        'LinkedIn',
        'Youtube',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->socialMediaOptions as $socialMediaOption) {
            DB::table($this->tableName)->insert([
                'title' => $socialMediaOption,
                'status' => true
            ]);
        }
    }
}
