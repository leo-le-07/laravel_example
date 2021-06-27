<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use App\Modules\User\Services\AuthService;
use Illuminate\Support\Facades\Log;
// use Illuminate\Http\Response;


class AuthController extends ApiController
{
    private $authService;

    public function __construct(){
        $this->authService = new AuthService();
    }


    public function register(Request $request){
        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|min:3'
        ]);

        $result = $this->authService->register($request);

        if(!$result){
            return $this->failure('Can not register', 500);
        }
        return $this->success('Register successfully', $result);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string|min:3'
        ]);
    

        $result = $this->authService->login($request);
        if(!$result){
            return $this->failure('Login fail', 201);
        }
        return $this->success('Login successfully', $result);
        
    }
    public function logout(Request $request){
       $this->authService->logout($request);
      
       return $this->success('Logout');
    }
}
