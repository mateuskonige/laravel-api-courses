<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CourseService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCourse;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseService->getCourses();

        return CourseResource::collection($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateCourse  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCourse $request)
    {
        $course = $this->courseService->createCourse($request->validated());

        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function show($identify)
    {
        $course = $this->courseService->getCourse($identify);

        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateCourse  $request
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCourse $request, $identify)
    {
        $this->courseService->updateCouse($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function destroy($identify)
    {
        $this->courseService->deleteCourse($identify);

        return response()->json([], 204);
    }
}
