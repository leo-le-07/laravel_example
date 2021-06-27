<?php

namespace App\Modules\User\Services;

use Illuminate\Support\Facades\Log;
use App\Modules\User\Repositories\HospitalRepository;

class HospitalService
{
    private $hospitalRepository;

    public function __construct(){
        $this->hospitalRepository = new HospitalRepository();
    }

    public function search(array $attributes)
    {
       return $this->hospitalRepository->search($attributes);
    }

    public function show($id)
    {
        return $this->hospitalRepository->model($id);
    }

    public function store(array $attributes)
    {
        return $this->hospitalRepository->create($attributes);
    }
    
    public function update(array $attributes, $id)
    {
        return $this->hospitalRepository->updateById($id,$attributes);

    }
    public function destroy($id){
        return $this->hospitalRepository->deleteWithIds([$id]);
    }

}
