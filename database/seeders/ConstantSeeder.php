<?php

namespace Database\Seeders;

use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConstantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $constants = [
            'contact',
            'fileType',
            'meetingStatus',
            'refereeType',
            'jobType'
        ];

        foreach ($constants as $constant){
            $const['name']=$constant;
            $const['parentId']=null;
            Constant::create($const);
        }
    }
}
