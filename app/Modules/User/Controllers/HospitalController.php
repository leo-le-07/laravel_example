<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Modules\User\Services\HospitalService;

class HospitalController extends ApiController
{
    private $hospitalService;

    public function __construct(){
        $this->hospitalService = new HospitalService();
    }

    public function index(Request $request)
    {
       $hospitals = $this->hospitalService->search($this->getSearch($request));

       return $this->success('Get all hospitals', $hospitals);
    }

    private function getSearch(Request $request){
        $search = [];
        $search['keyword'] = $request->input('keyword');
        return $search;
    }


    public function show($id)
    {
        $hospital = $this->hospitalService->show($id);

        if(!$hospital){
            return $this->failure('Not Found Hospital', 404);
        }
        return $this->success('Get detail hospital', $hospital);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255|unique:hospitals,name',
        ]);

        $attributes = $request->only(['name', 'logo', 'description', 'phone', 'address']);

        Log::debug($attributes);

        $result = $this->hospitalService->store($attributes);

        if(!$result){
            return $this->failure('Error', 201);
        }
        return $this->success('Create hospital successfully', $result);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max:255',
        ]);

        $attributes = $request->only(['name', 'logo', 'description', 'phone', 'address']);

        $result = $this->hospitalService->update($attributes, $id);

        if(!$result){
            return $this->failure('Error', 201);
        }
        return $this->success('Update hospital successfully', $result);
    }

    public function destroy(int $id){
       $this->hospitalService->destroy($id);
    }

}
