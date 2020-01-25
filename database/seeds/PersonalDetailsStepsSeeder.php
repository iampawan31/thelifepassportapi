<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalDetailsStepsSeeder extends Seeder
{
    protected $tableName = "personal_details_steps";
    protected $personalDetailSteps = array(
        array('Your personal details', 'personal_details', 10, 1),
        array('Are you married?', 'spouse', 10, 2),
        array('Were you previously married?', 'previous_spouse', 10, 3),
        array('Would you like to add close family members including children?', 'family_members', 10, 4),
        array('Would you like any close friends contacted?', 'close_friends', 10, 5),
        array('Do you have any home assistants?', 'home_assistants', 10, 6),
        array('Do you have a personal representative for your estate?', 'estate_representative', 10, 7),
        array('Does your spouse/life partner/signifcant other have a personal representative of their estate?', 'spouse_estate_representative', 10, 8),
        array('Do you belong to any professional, religious, non-profit, civic or social organizations?', 'religious_organization', 10, 9),
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->personalDetailSteps as $personalDetailStep) {
            DB::table($this->tableName)->insert([
                'step' => $personalDetailStep[0],
                'slug' => $personalDetailStep[1],
                'percentage' => $personalDetailStep[2],
                'sequence' => $personalDetailStep[3]
            ]);
        }
    }
}
