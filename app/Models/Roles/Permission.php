<?php

namespace App\Models\Roles;

use Jenssegers\Mongodb\Eloquent\Model;

class Permission extends Model
{
    protected $connection='mongodb';
    protected $collection='permissions';
    protected $primaryKey='name';
    protected $fillable=[
        'name'
    ];
    protected $hidden=[
        'created_at',
        'updated_at'
    ];
}
