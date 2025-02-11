<?php

namespace Database\Seeders;

use App\Models\Constant;
use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Constant::where('name','contact')->first()->_id;
        $contacts=[
            'telephone',
            'cellphone',
            'email',
            'whatsapp',
            'telegram',
            'facebook'
        ];
        foreach ($contacts as $contact) {
            $cont['name']=$contact;
            $cont['parentId']=$parent;
            Constant::create($cont);
        }

    }
}
