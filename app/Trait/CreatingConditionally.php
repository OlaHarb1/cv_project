<?php

namespace App\Trait;
trait CreatingConditionally
{
    protected static function booting(){
        parent::booting();
        self::creating(function($model) {
            $query = new self();
            $orKey = property_exists(self::class, "or") && self::$or;
            foreach (self::$uniqueKeys as $k) {
                $query = $query->where($k, $model[$k]);
                if($orKey){
                    $query=$query->orWhere($k,$model[$k]);
                }
            }
            throw_if($query->first()!=null,new \Exception('already exists!',433));
        });
    }
}
