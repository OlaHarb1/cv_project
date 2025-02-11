<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model;
use Mockery\Matcher\Not;

class Person extends Model
{
    use  HasFactory, Notifiable;
protected $connection='mongodb';
protected $collection='persons';
protected $guarded=['_id'];

//    protected $fillable=[
//        'localID',
//        'name',
//        'education',
//        'experience',
//        'address',
//        'availability',
//        'autSourcePath',
//        'referee',
//        'isMale',
//        'rating',
//        'birthday',
//        'refereeType',
//        'countryId',
//        'stateId',
//        'isFavorable',
//        'avatarFileId',
//    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJobAttribute(){
        return $this->hasMany(Job::class,'personId','_id')->get();
    }
    public function getContactAttribute(){
        return $this->hasMany(Contact::class,'personId','_id')->get();
    }
    public function getMeetingsAttribute(){
        return $this->hasMany(Meeting::class,'personId','_id')->get();
    }
    public function getCountryAttribute(){
        return $this->belongsTo(Contact::class,'countryId','_id')->get();
    }
    public function getStateAttribute(){
        return $this->belongsTo(Contact::class,'stateId','_id')->get();
    }
    public function getFilesAttribute(){
        return $this->morphMany(File::class,'fileable','fileable_type','fileable,_id')->get();
    }
    public function getNotesAttribute(){
        return $this->morphMany(Note::class,'noteable','noteable_type','noteable,_id')->get();
    }
}
