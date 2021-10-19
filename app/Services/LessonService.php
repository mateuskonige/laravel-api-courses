<?php

namespace App\Services;

use App\Repositories\ModuleRepository;
use App\Repositories\LessonRepository;

class LessonService
{
    protected $repository, $moduleRepository;

    public function __construct(LessonRepository $lessonRepository, ModuleRepository $moduleRepository)
    {
        $this->repository = $lessonRepository;
        $this->moduleRepository = $moduleRepository;
    }

    public function getLessonsByModule(string $moduleUuid)
    {
        $module = $this->moduleRepository->getModuleByUuid($moduleUuid);

        return $this->repository->getAllLessonsByModule($module->id);
    }

    public function createLesson(array $data, string $moduleUuid)
    {
        $module = $this->moduleRepository->getModuleByUuid($moduleUuid);

        return $this->repository->createNewLesson($module->id, $data);
    }

    public function getLessonByModule(string $moduleUuid, string $identity)
    {
        $module = $this->moduleRepository->getModuleByUuid($moduleUuid);

        return $this->repository->getLessonByModule($module->id, $identity);
    }

    public function updateLesson(array $data, string $moduleUuid, string $identity)
    {
        $module = $this->moduleRepository->getModuleByUuid($moduleUuid);

        return $this->repository->updateLessonByModule($data, $module->id, $identity);
    }

    public function deleteLesson(string $moduleUuid, string $identity)
    {
        $module = $this->moduleRepository->getModuleByUuid($moduleUuid);

        return $this->repository->deleteLessonByModule($module->id, $identity);
    }
}
