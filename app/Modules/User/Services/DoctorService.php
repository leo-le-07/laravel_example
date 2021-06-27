<?php

namespace App\Modules\User\Services;

use Illuminate\Support\Facades\Log;
use App\Modules\User\Repositories\DoctorRepository;

class DoctorService
{
    private $doctorRepository;

    public function __construct(){
        $this->doctorRepository = new DoctorRepository();
    }

    public function search(array $attributes)
    {
       return $this->doctorRepository->search($attributes);
    }

    public function show($id)
    {
        return $this->doctorRepository->model($id);
    }

    public function store(array $attributes)
    {
        return $this->doctorRepository->create($attributes);
    }
    
    public function update(array $attributes, $id)
    {
        return $this->doctorRepository->updateById($id,$attributes);
    }

    public function destroy($id){
        return $this->doctorRepository->deleteWithIds([$id]);
    }

}
