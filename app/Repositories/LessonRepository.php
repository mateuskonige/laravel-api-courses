<?php

namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository
{
    protected $entity;

    public function __construct(Lesson $lesson)
    {
        $this->entity = $lesson;
    }

    public function getAllLessonsByModule(int $moduleId)
    {
        return $this->entity
            ->where('module_id', $moduleId)
            ->get();
    }

    public function createNewLesson(int $moduleId, array $data)
    {

        $data['module_id'] = $moduleId;
        return $this->entity->create($data);
    }

    public function getLessonByModule(string $moduleId, string $identify)
    {
        return $this->entity
            ->where('module_id', $moduleId)
            ->where('uuid', $identify)
            ->firstOrFail();
    }

    public function updateLessonByModule(array $data, int $moduleId, string $identify)
    {
        $lesson = $this->getLessonByModule($moduleId, $identify);
        return $lesson->update($data);
    }

    public function deleteLessonByModule(int $moduleId, string $identify)
    {
        $lesson = $this->getLessonByModule($moduleId, $identify);
        return $lesson->delete();
    }
}
