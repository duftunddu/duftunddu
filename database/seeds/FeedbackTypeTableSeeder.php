<?php

use App\Feedback_Type;
use Illuminate\Database\Seeder;

class FeedbackTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feedback_Type::firstOrCreate([
            'name'   => 'Interface',
        ]);
        
        Feedback_Type::firstOrCreate([
            'name'   => 'Functionality',
        ]);
        
        Feedback_Type::firstOrCreate([
            'name'   => 'Accessibility',
        ]);
        
        Feedback_Type::firstOrCreate([
            'name'   => 'Other',
        ]);
    }
}
