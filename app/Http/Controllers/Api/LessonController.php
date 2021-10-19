<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\LessonService;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Requests\StoreUpdateLesson;

class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($moduleUuid)
    {
        $lessons = $this->lessonService->getLessonsByModule($moduleUuid);

        return LessonResource::collection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateLesson  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateLesson $request, $moduleUuid)
    {
        $lesson = $this->lessonService->createLesson($request->validated(), $moduleUuid);

        return new LessonResource($lesson);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $identify
     * @return \Illuminate\Http\Response
     */
    public function show($moduleUuid, $identify)
    {
        $lesson = $this->lessonService->getLessonByModule($moduleUuid, $identify);

        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateLesson  $request
     * @param  int  $identify
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateLesson $request, $moduleUuid, $identify)
    {
        $this->lessonService->updateLesson($request->validated(), $moduleUuid, $identify);

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $identify
     * @return \Illuminate\Http\Response
     */
    public function destroy($moduleUuid, $identify)
    {
        $this->lessonService->deleteLesson($moduleUuid, $identify);

        return response()->json([], 204);
    }
}
