<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository {
    protected $entity;

    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    public function getAllModulesbyCourse()
    {
        return $this->entity->all();
    }

    public function createNewModule($data){
        return $this->entity->create($data);
    }

    public function getModulebyCourse() {

    }

    public function updateModuleByUuid(array $data, string $identity){

    }

    public function deleteModuleByUuid(string $identity) {

    }
}