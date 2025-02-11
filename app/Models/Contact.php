<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $connection='mongodb';
    protected $collection='contacts';
    protected $guarded=['_id'];
//    protected $fillable=[
//        'localID',
//        'value',
//        'contactTypeId',
//        'personId',
//    ];
    public function getPersonAttribute(){
        return $this->belongsTo(Person::class,'personId','_id')->first();
    }
}
