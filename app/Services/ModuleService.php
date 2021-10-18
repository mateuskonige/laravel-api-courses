<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Repositories\ModuleRepository;

class ModuleService {
    protected $repository, $courseRepository;

    public function __construct(ModuleRepository $moduleRepository, CourseRepository $courseRepository)
    {
        $this->repository = $moduleRepository;
        $this->courseRepository = $courseRepository;
    }

    public function getModulesByCourse(string $course) {
        $course = $this->courseRepository->getCourseByUuid($course);
        
        return $this->repository->getAllModulesByCourse($course->id);
    }

    public function createModule(array $data)
    {
        return $this->repository->createNewModule($data);
    }

    public function getModuleByCourse(string $course, string $identity)
    {
        $course = $this->courseRepository->getCourseByUuid($course);

        return $this->repository->getModulebyCourse($course->id, $identity);
    }

    public function updateModule(array $data, string $identity)
    {
        return $this->repository->updateModuleByUuid($data, $identity);
    }

    public function deleteModule(string $identity)
    {
        return $this->repository->deleteModuleByUuid($identity);
    }
}