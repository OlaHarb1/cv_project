<?php

namespace Database\Seeders;

use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Constant::where('name','fileType')->first()->_id;
        $fileTypes=[
            'avatar',
            'resume',
            'privateDocument',
            'identityPhoto',
            'passportDocument',
            'galleryPhoto',
            'video',
            'animation',
            'generalPdf',
            'compressedFile',
            'executable',
            'other'
        ];
        foreach ($fileTypes as $fileType){
            $f['parentId']= $parent;
            $f['name']=$fileType;
            Constant::create($f);
        }
    }
}
