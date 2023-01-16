<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request) {
        $incomingFields = $request->validate(['loginname' => 'required', 'loginpassword' => 'required']);
        if(auth() -> attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])){
            $request -> session() -> regenerate();
            echo('11111');
        }
        echo('22211');
        return redirect('/');
    }

    public function logout(){
        auth() -> logout();
        return redirect('/');
    }
    
    public function register(Request $request) {
        $incomingFields = $request -> validate([
            'name' => ['required', 'min:3', 'max:200', Rule::unique('users','name')],
            'email' => ['required', 'email', Rule::unique('users','email')],
            'password' => ['required', 'min:3']
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
         $user = User::create($incomingFields);
        auth() -> login($user);
        return redirect('/');
    }
}