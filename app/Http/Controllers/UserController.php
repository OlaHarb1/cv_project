<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\Roles\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request, Role $role){
        $data = $request->all();
        $data['password']=Hash::make($data['password']);
        unset($data['password_confirmation']);
        $user=User::create($data);
        $user->assignMainRole($role->name);
        return 'add successfully';
    }
    public function login(UserRequest $request){
        $data = $request->only(['email','password']);
        throw_if(!Auth::attempt($data),'failed to login');
        return [
            'message'=>'login successfully',
            'token'=>\auth()->user()->createToken($request->ip())->plainTextToken
        ];
    }
}
