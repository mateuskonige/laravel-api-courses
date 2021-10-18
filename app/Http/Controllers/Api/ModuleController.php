<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ModuleService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Http\Requests\StoreUpdateModule;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course)
    {
        $modules = $this->moduleService->getModulesByCourse($course);

        return ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateModule  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateModule $request)
    {
        $module = $this->moduleService->createModule($request->validated());

        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function show($course, $identify)
    {
        $module = $this->moduleService->getModuleByCourse($course, $identify);

        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateModule  $request
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function update($identify, StoreUpdateModule $request)
    {
        $this->moduleService->updateModule($identify, $request->validated());

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
        $this->moduleService->deleteModule($identify);

        return response()->json([], 204);
    }

}
