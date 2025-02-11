<?php

namespace App\Trait;

use App\Models\Roles\Permission;

trait HasPermission
{

    public function can($permission){
        $isTrue=false;
        if(!$permission instanceof Permission) $permission=Permission::where('name',$permission)->firstOrFail();
        foreach (self::getUserHasRoleAttribute() as $userToRole){
            $permission =$userToRole->role->permissions->where('_id',$permission->_id)->first();
            if($permission!=null) $isTrue=true;
        }
        return $isTrue;
    }
}
