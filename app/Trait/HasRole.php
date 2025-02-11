<?php

namespace App\Trait;

use App\Models\Roles\Role;
use App\Models\Roles\UserHasRole;

trait HasRole
{
    private function check($role){
        if (!($role instanceof Role)) $role= Role::where('name','=',$role)->firstOrFail();
       $model= UserHasRole::where('userId',$this->_id)->where('roleId','=',$role->_id)->first();
     return ['role'=>$role,'model'=>$model];
    }

    public function roles(){
        $roles=[];
      $model_roles= UserHasRole::where('userId','=',$this->_id)->get();
      foreach ($model_roles as $role){
          $roles[]=$role->role->name;
      }
      if($this->roleId!=null){
          $roles[]=Role::where('_id',$this->roleId)->first()->name;
      }
        return $roles;
    }

    public function assignMainRole($role){
      $this->roleId=Role::where('name',$role)->first()->_id;
      $this->save();
    }

    public function assignRole($role){
        $role=$this->check($role)['role'];
       if($this->check($role)['model']==null){
           $modelHasRole=new UserHasRole(['userId'=>$this->_id,'roleId'=>$role->_id]);
           $modelHasRole->save();
       }
        return true;
    }

    //use roleId from model user
    public function hasRole($role){
        $hasRole=false;
        $role=Role::where('name',$role)->first()->_id;
        if($this->roleId==$role){
           $hasRole=true;
        }
        return $hasRole;
    }

    public function removeMainRole(){
        $this->roleId=null;
        $this->save();
        return true;
    }

    public function removeRole($role){
        $isDelete=false;
        $role=$this->check($role)['role'];
            $model_role=$this->check($role)['model'];
            if($model_role->exists()){
                $model_role->delete();
                $isDelete=true;
            }

        return $isDelete;
    }

    public function asnycRole(){
        $isDelete=false;
       $delete= UserHasRole::where('userId',$this->_id)->delete();
       if ($delete>0) $isDelete=true;
       return $isDelete;
    }
}
