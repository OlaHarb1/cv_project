<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $connection='mongodb';
    protected $collection='jobs';
    protected $guarded=['_id'];
    protected $fillable=[
      'localID',
      'name',
      'sortRatio' ,
      'personId'
    ];
    public function getPersonAttribute(){
        return $this->belongsTo(Person::class,'personId','_id')->first();
    }
}
