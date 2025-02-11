<?php

namespace Database\Seeders;

use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MettingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Constant::where('name','meetingStatus')->first()->_id;
        $meetingStatus=[
            'completed',
            'onSchedule',
            'pending',
            'postponed',
            'canceled',
            'rejected',
        ];
        foreach ($meetingStatus as $meeting) {
            $cont['name']=$meeting;
            $cont['parentId']=$parent;
            Constant::create($cont);
        }
    }
}
