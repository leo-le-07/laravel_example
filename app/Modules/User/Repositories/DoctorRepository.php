<?php

namespace App\Modules\User\Repositories;

use App\Models\Doctor;

use Illuminate\Support\Facades\Log;

class DoctorRepository extends ModelRepository
{

    protected function modelClass(){
        return Doctor::class;
    }

    public function search($search=[]){
        $query = $this->query();

        if(filled($search['keyword'] ?? '')){
            $query->where('name', 'LIKE', '%'.$search['keyword'].'%');
        }
        return $this->fetchQuery($query);
    }

    public function create(array $attributes){

        $doctor = $this->createWithAttributes($attributes);

        $specialties = $attributes['specialties'];
   
        $doctor->specialties()->sync($specialties);

        return $this->model;
    }
    
    public function updateById($id, array $attributes){
        $specialties = $attributes['specialties'];

        unset($attributes['specialties']);
        $doctor = $this->updateByIdWithAttributes($attributes, $id, true);

        $doctor->specialties()->sync($specialties);

        return $doctor;
    }

}
