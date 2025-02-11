<?php

namespace Database\Seeders;

use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefereeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent=Constant::where('name','refereeType')->first();
        $referees=[
            'none',
            'friend',
            'groupOfFriends',
            'university',
            'facebookPage',
            'telegramGroup',
            'socialSite',
            'printedPublication',
            'television',
            'radio',
            'website',
            'magazine',
            'newspaper',
            'outsideBanner',
            'application'
        ];
        foreach ($referees as $referee){
            $r['parentId']=$parent->_id;
            $r['name']=$referee;
            Constant::create($r);
        }

    }
}
