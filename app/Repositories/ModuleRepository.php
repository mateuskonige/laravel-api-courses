<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository {
    protected $entity;

    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    public function getAllModulesbyCourse(int $courseId)
    {
        return $this->entity
                    ->where('course_id', $courseId)
                    ->get();
    }

    public function createNewModule(int $courseId, array $data){

        $data['course_id'] = $courseId;
        return $this->entity->create($data);
    }

    public function getModuleByUuid(string $identify)
    {
        return $this->entity->where('uuid', $identify)->firstOrFail();
    }

    public function getModulebyCourse(string $courseId, string $identify) {
        return $this->entity
                    ->where('course_id', $courseId)
                    ->where('uuid', $identify)
                    ->firstOrFail();
    }

    public function updateModuleByCourse(array $data, int $courseId, string $identify){
        $module = $this->getModulebyCourse($courseId, $identify);
        return $module->update($data);
    }

    public function deleteModuleByCourse(int $courseId, string $identify) {
        $module = $this->getModulebyCourse($courseId, $identify);
        return $module->delete();
    }
}