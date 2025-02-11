<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $connection='mongodb';
    protected $collection='businesses';
    protected $guarded=['_id'];
//    protected $fillable=[
//        'address',
//        'name',
//        'countryId',
//        'stateId',
//    ];
    public function getCountryAttribute(){
        return $this->belongsTo(Contact::class,'countryId','_id')->get();
    }
    public function getStateAttribute(){
        return $this->belongsTo(Contact::class,'stateId','_id')->get();
    }
}
