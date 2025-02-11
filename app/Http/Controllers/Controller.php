<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected  function filter($model,$data,$search=null){
        if($search!=null){
            foreach ($data as $k=>$value){
                if($k==0){
                    $model=$model->where($value,"like","%".$search."%");
                }else{
                    $model=$model->orWhere($value,"like","%".$search."%");
                }

            }
        }else{
            foreach ($data as $index=>$value){
                $model=$model->where($index,$value);
            }
        }
        return $model->get();
    }

}
