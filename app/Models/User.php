<?php

namespace App\Models;

use App\Trait\HasPermission;
use App\Trait\HasRole;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as Authtrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Model implements Authenticatable

{
    use  Authtrait, HasApiTokens, HasRole, HasPermission, Notifiable;

    //TODO ADD TRAIT CreatingConditionally

    protected $connection = 'mongodb';
    protected $collection = 'users';
    protected $guarded = ['_id', 'roleId'];

//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//        'roleId',
//        'personId',
//        'businessId'
//    ];

    public function getPersonAttribute()
    {
        return $this->belongsTo(Person::class, 'personId', '_id')->first();
    }

    public function getBusinessAttribute()
    {
        return $this->belongsTo(Business::class, 'businessId', '_id')->first();
    }

}
