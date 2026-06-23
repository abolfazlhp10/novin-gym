<?php

namespace Modules\Exercise\Http\Controllers\V1\User;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Exercise\Classes\V1\ResponseMessages;
use Modules\Exercise\Services\V1\ExerciseService;
use Modules\Exercise\Transformers\V1\ExerciseResource;

class ExerciseController extends Controller
{
    public function __construct(private ExerciseService $exerciseService, private ApiResponse $apiResponse) {}

    public function index(): JsonResponse
    {
        $exercises = $this->exerciseService->getAll();

        return $this->apiResponse->successResponse(ResponseMessages::GET_ALL_EXERCISES_SUCCESS, ExerciseResource::collection($exercises), 200);
    }
}
