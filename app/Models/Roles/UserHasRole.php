<?php

namespace App\Models\Roles;
use App\Models\User;
use App\Trait\CreatingConditionally;
use Jenssegers\Mongodb\Eloquent\Model;

class UserHasRole extends Model
{
    use CreatingConditionally;
    protected static array $uniqueKeys = ['roleId', 'userId'];
    protected $connection='mongodb';
    protected $collection="user_has_roles";
    protected $guarded=['_id'];
    protected $fillable=[
        'roleId',
        'userId'
    ];
    protected $hidden=['created_at',"updated_at"];
    public function getRoleAttribute(){
        return $this->belongsTo(Role::class,'roleId','_id')->first();
    }
    public function getUserAttribute(){
        return $this->belongsTo(User::class,'userId','_id')->first();
    }
}
