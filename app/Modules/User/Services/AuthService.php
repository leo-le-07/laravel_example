<?php

namespace App\Modules\User\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Modules\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService 
{
    private $userRepository;

    public function __construct(){
        $this->userRepository = new UserRepository();
    }

    public function register(Request $request){
        $data = $request->only(['name','email','password']);
       
        $data['password'] = bcrypt($data['password']);

        $user = $this->userRepository->create($data);

        $token = $user->createToken('myapptoken')->plainTextToken;
        return [
            'user'=>$user,
            'token' => $token
        ];
    }

    public function login(Request $request){
        $data = $request->only(['email','password']);
 
        $user = $this->userRepository->findByEmail($data['email']);
     
        if(!$user || !Hash::check($data['password'], $user->password)){
            return null;
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        return [
            'user'=>$user,
            'token' => $token
        ];

        
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
    }
}
