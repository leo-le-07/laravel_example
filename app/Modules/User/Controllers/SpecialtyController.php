<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Modules\User\Services\SpecialtyService;

class SpecialtyController extends ApiController
{
    private $specialtyService;

    public function __construct(){
        $this->specialtyService = new SpecialtyService();
    }

    public function index(Request $request)
    {
       $specialties = $this->specialtyService->search($this->getSearch($request));

       return $this->success('Get all specialties', $specialties);
    }

    private function getSearch(Request $request){
        $search = [];
        $search['keyword'] = $request->input('keyword');
        return $search;
    }

    public function show($id)
    {
        $specialty = $this->specialtyService->show($id);

        if(!$specialty){
            return $this->failure('Not Found Specialty', 404);
        }
        return $this->success('Get detail specialty', $specialty);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255|unique:specialties,name',
        ]);

        $attributes = $request->only(['name', 'image', 'description']);

        $result = $this->specialtyService->store($attributes);

        if(!$result){
            return $this->failure('Error', 201);
        }
        return $this->success('Create speacialty successfully', $result);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max:255',
        ]);

        $attributes = $request->only(['name', 'image', 'description']);
        
        $result = $this->specialtyService->update($attributes, $id);

        if(!$result){
            return $this->failure('Error', 201);
        }
        return $this->success('Update specialty successfully', $result);
    }

    public function destroy($id)
    {
        $this->specialtyService->destroy($id);
    }
}
