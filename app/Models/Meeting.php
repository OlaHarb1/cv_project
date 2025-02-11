<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Mockery\Matcher\Not;

class Meeting extends Model
{
    use HasFactory;
    protected $connection='mongodb';
    protected $collection='meetings';
    protected $guarded=['_id'];
    protected $fillable=[
      'localId',
      'rating',
      'meetingStatus',
      'administrationOpinion',
      'outSourcePath',
      'startDate',
      'endDate',
      'personId'
    ];
    protected $casts=[
        'startDate'=>['date'],
        'endDate'=>['date'],
    ];
    public function getNotesAttribute(){
        return $this->morphMany(Note::class,'noteable','noteable_type','noteable,_id')->get();
    }
    public function getMeetingAttribute(){
        return $this->belongsTo(Person::class,'personId','_id')->first();
    }
}
