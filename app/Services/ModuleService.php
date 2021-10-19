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

    public function getModulesByCourse(string $courseUuid) {
        $course = $this->courseRepository->getCourseByUuid($courseUuid);
        
        return $this->repository->getAllModulesByCourse($course->id);
    }

    public function createModule(array $data, string $courseUuid)
    {
        $course = $this->courseRepository->getCourseByUuid($courseUuid);
        
        return $this->repository->createNewModule($course->id, $data);
    }

    public function getModuleByCourse(string $courseUuid, string $identity)
    {
        $course = $this->courseRepository->getCourseByUuid($courseUuid);

        return $this->repository->getModulebyCourse($course->id, $identity);
    }

    public function updateModule(array $data, string $courseUuid, string $identity)
    {
        $course = $this->courseRepository->getCourseByUuid($courseUuid);
        
        return $this->repository->updateModuleByCourse($data, $course->id, $identity);
    }

    public function deleteModule(string $courseUuid, string $identity)
    {
        $course = $this->courseRepository->getCourseByUuid($courseUuid);

        return $this->repository->deleteModuleByCourse($course->id, $identity);
    }
}