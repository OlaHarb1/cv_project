<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConstantRequest;
use App\Models\Constant;
use Illuminate\Http\Request;

class ConstantController extends Controller
{
    public function create(ConstantRequest $request)
    {
        Constant::create($request->all());
        return 'save successfully';
    }

    public function update(ConstantRequest $request, Constant $constant)
    {
        $constant->update($request->all());
        return 'updated successfully';
    }

    //superAdmin,admin
    public function view(ConstantRequest $request)
    {

        return $this->filter(Constant::query(),$request->all())->append(['parent','children']);
    }

    //soft Delete
    public function delete(Constant $constant)
    {
        $constant->delete();
        return 'delete successfully';
    }

    public function get(Constant $constant)
    {
        return $constant->append(['children']);
    }

    public function constantSearch($search){
        return $this->filter(Constant::query(),['name'],$search);
    }
}
