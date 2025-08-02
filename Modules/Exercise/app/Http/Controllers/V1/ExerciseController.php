<?php
namespace Modules\Exercise\Http\Controllers\V1;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Modules\Exercise\Classes\V1\ResponseMessages;
use Modules\Exercise\Http\Requests\V1\StoreExerciseRequest;
use Modules\Exercise\Http\Requests\V1\UpdateExerciseRequest;
use Modules\Exercise\Models\V1\Exercise;
use Modules\Exercise\Services\V1\ExerciseService;
use Modules\Exercise\Transformers\V1\ExerciseCollection;
use Modules\Exercise\Transformers\V1\ExerciseResource;

class ExerciseController extends Controller
{

    public function __construct(private ExerciseService $exerciseService, private ApiResponse $apiResponse)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercises = new ExerciseCollection($this->exerciseService->getAll());
        return $this->apiResponse->successResponse(ResponseMessages::GET_ALL_EXERCISES_SUCCESS, $exercises, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExerciseRequest $request)
    {
        $exercise = new ExerciseResource($this->exerciseService->create($request->validated()));
        return $this->apiResponse->successResponse(ResponseMessages::GET_EXERCISE_SUCCESS, $exercise, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show(Exercise $exercise)
    {
        $exercise = new ExerciseResource($exercise);
        return $this->apiResponse->successResponse(ResponseMessages::GET_EXERCISE_SUCCESS, $exercise, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Exercise $exercise, UpdateExerciseRequest $request)
    {
        $exercise = new ExerciseResource($this->exerciseService->update($exercise, $request->validated()));
        return $this->apiResponse->successResponse(ResponseMessages::UPDATE_EXERCISE_SUCCESS, $exercise, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        $this->exerciseService->delete($exercise);
        return $this->apiResponse->successResponse(ResponseMessages::DELETE_EXERCISE_SUCCESS, [], 200);
    }
}
