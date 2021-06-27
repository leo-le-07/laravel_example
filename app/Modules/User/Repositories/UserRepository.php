<?php

namespace App\Modules\User\Repositories;

use App\Models\User;


class UserRepository extends ModelRepository
{

    protected function modelClass(){
        return User::class;
    }

    public function findByEmail($email){
        $query = $this->query();
        $query->where('email',$email);
        return $this->fetchQueryFirst($query);
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
