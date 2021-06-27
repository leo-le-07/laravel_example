<?php

namespace App\Http\Controllers;

trait ApiResponseTrait
{
   protected function success($message, $data=[], $status = 200){
       return response([
           'success' => true,
           'data' => $data,
           'message'=> $message
       ], $status);
   }
   protected function failure($message, $status = 422){
       return response([
           'success' => false,
           'message' => $message,
       ],$status);
   }
}
