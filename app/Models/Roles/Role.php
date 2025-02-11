<?php

namespace App\Models\Roles;
use App\Models\Category;
use App\Trait\CreatingConditionally;
use Jenssegers\Mongodb\Eloquent\Model;


class Role extends Model
{
    use CreatingConditionally;
    protected static array $uniqueKeys = ['centerId', 'name'];
    protected $connection='mongodb';
    protected $collection='roles';
    protected $guarded=['_id'];
//    protected $fillable=[
//        'id',
//        'name',
//        'centerId',
//    ];
    public function getCenterAttribute(){
        return $this->belongsTo(Category::class,'_id','centerId')->first();
    }
    public function getRoleHasUserAttribute(){
        return $this->hasMany(UserHasRole::class,'roleId','_id')->get();
    }
    public function permissions(){
        return $this->embedsMany(Permission::class);
    }


}
