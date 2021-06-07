<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\User2;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    function register(Request $req)
    {
        $user = new User;
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->phone = $req->input('phone');
        $user->pssword= Hash::make($req->input('password'));
        $user->save();
        return $user;
    }
    function login(Request $req)
    {
        $user = User::where('email',$req->email)->first();
        if(!$user || !Hash::check($req->password,$user->pssword))
        {
            return ["error"=>"Email or Password Not Match"];
        }
        return $user;
    }
    function list(){
        return User::all();
    }
    function getlist($id){
        return User::find($id);
    }
    function update($id, Request $req)
    {
        $user = User::find($id);
        $user->name = $req->input('name') ;
        $user->email = $req->input('email') ;
        $user->phone = $req->input('phone') ;
        $user->save();
        return $user;
    }
 }
