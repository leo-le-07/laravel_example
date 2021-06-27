<?php

namespace App\Modules\User\Services;

use Illuminate\Support\Facades\Log;
use App\Modules\User\Repositories\SpecialtyRepository;

class SpecialtyService
{
    private $specialtyRepository;

    public function __construct(){
        $this->specialtyRepository = new SpecialtyRepository();
    }

    public function search(array $attributes)
    {
       return $this->specialtyRepository->search($attributes);
    }

    public function show($id)
    {
        return $this->specialtyRepository->model($id);
    }

    public function store(array $attributes)
    {
        return $this->specialtyRepository->create($attributes);
    }
    
    public function update(array $attributes, $id)
    {
        return $this->specialtyRepository->updateById($id,$attributes);

    }
    public function destroy($id){
        return $this->specialtyRepository->deleteWithIds([$id]);
    }

}
