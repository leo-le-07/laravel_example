<?php

namespace App\Modules\User\Repositories;

use App\Models\Hospital;


class HospitalRepository extends ModelRepository
{

    protected function modelClass(){
        return Hospital::class;
    }

    public function search($search=[]){
        $query = $this->query();

        if(filled($search['keyword'] ?? '')){
            $query->where('name', 'LIKE', '%'.$search['keyword'].'%');
        }
        return $this->fetchQuery($query);
    }

    public function create(array $attributes){
        $this->createWithAttributes($attributes);
        return $this->model;
    }
    
    public function updateById($id, array $attributes){
        $hospital = $this->updateByIdWithAttributes($attributes, $id, true);
        return $hospital;
    }

}
