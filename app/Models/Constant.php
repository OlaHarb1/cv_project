<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Constant extends Model
{
    use HasFactory,SoftDeletes;
    protected $connection='mongodb';
    protected $collection='constants';
    protected $guarded=['_id'];
//protected $fillable=[
//    'parentId',
//    'name',
//    ////
//    'name',
//    'icon',
//    'codePoint',
//    'fontFamily',
//    'fontPackage'
//];
    public function getParentAttribute(){
        return $this->belongsTo(self::class,'parentId','_id')->first();
    }
    public function getChildrenAttribute(){
        return $this->belongsToMany(self::class,'_id',"parentId")->get();
    }
}
