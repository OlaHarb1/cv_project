<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $connection='mongodb';
    protected $collection='notes';
    protected $guarded=['_id'];
//    protected $fillable=[
//        'noteable_type',
//        'noteable_id',
//        'description'
//    ];
    public function noteable(){
        return $this->morphTo('noteable');
    }
}
