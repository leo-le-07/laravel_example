<?php

namespace App\Modules\User\Repositories;
use Illuminate\Support\Facades\Log;

abstract class ModelRepository
{
    protected $modelClass;

    protected $model;

    public function __construct($id = null){
        $this->modelClass = $this->modelClass();
        $this->model($id);
    }

    protected abstract function modelClass();

    public function query(){
        return $this->rawQuery();
    }
    public function rawQuery(){
        return call_user_func($this->modelClass.'::query');
    }

    public function getAll(){
        return $this->query()->all();
    }

    public function getById($id, $strict = true){
        return $strict ? $this->query()->findOrFail($id) : $this->query()->find($id);
    }

    public function queryByIds($ids){
        return $this->query()->whereIn('id', $ids);
    }

    protected function fetchQuery($query){
        return $query->get();
    }

    protected function fetchQueryFirst($query){
        return $query->first();
    }
    public function model($id=null){
        if(!empty($id)){
            $this->model = $id instanceof Model ? $id : $this->getById($id, false);
        }
        return $this->model;
    }

    public function createWithAttributes(array $attributes){
        $this->model = $this->rawQuery()->create($attributes);

        return $this->model;
    }

    public function updateByIdWithAttributes(array $attributes, $id, $fresh = false){
        
        $result = $this->query()->where('id',$id)->update($attributes);

        return $fresh ? $this->getById($id) : $result;
    }
    
    public function deleteWithIds(array $ids){
        $this->query()->whereIn('id', $ids)->delete();
    }
}
