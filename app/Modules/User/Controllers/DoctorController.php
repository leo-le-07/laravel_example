<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Modules\User\Services\DoctorService;

class DoctorController extends ApiController
{
    private $doctorService;

    public function __construct(){
        $this->doctorService = new DoctorService();
    }

    public function index(Request $request)
    {
       $doctors = $this->doctorService->search($this->getSearch($request));

       return $this->success('Get all doctors', $doctors);
    }

    private function getSearch(Request $request){
        $search = [];
        $search['keyword'] = $request->input('keyword');
        $search['hospital_id'] = $request->input('hospital_id');
        return $search;
    }


    public function show($id)
    {
        $doctor = $this->doctorService->show($id);

        if(!$doctor){
            return $this->failure('Not Found Doctor', 404);
        }
        return $this->success('Get detail doctor', $doctor);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'hospital_id' => 'required|exists:hospitals,id',
            'email' => 'required|email|unique:doctors,email',
        ]);

        $attributes = $request->only(['hospital_id', 'name', 'email', 'gender','description','avatar', 'specialties']);

        $result = $this->doctorService->store($attributes);

        if(!$result){
            return $this->failure('Error', 201);
        }
        return $this->success('Create doctor successfully', $result);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max:255',
        ]);

        $attributes = $request->only(['hospital_id', 'name', 'email', 'gender','description','avatar', 'specialties']);

        $result = $this->doctorService->update($attributes, $id);

        if(!$result){
            return $this->failure('Error', 201);
        }
        return $this->success('Update doctor successfully', $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
