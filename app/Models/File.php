<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $connection='mongodb';
    protected $collection='files';
    protected $guarded=['_id'];
    protected $fillable=[
        'localID',
        'path',
        'originalFileName',
        'fileable_type',
        'fileable_id',
        'extension',
    ];
    public function fileable(){
        return $this->morphTo('fileable');
    }
}
