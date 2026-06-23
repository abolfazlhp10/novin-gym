<?php

namespace Modules\Support\Http\Controllers\V1\Admin;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Support\app\Classes\V1\ResponseMessages;
use Modules\Support\Models\Feedback;

class FeedbackController extends Controller
{
    public function __construct(private ApiResponse $apiResponse) {}

    public function index(): JsonResponse
    {
        $feedbacks = Feedback::paginate(10);

        return $this->apiResponse->successResponse(ResponseMessages::GET_ALL_FEEDBACKS_SUCCESS, $feedbacks, 200);
    }

    public function show(Feedback $feedback): JsonResponse
    {
        return $this->apiResponse->successResponse(ResponseMessages::GET_FEEDBACK_SUCCESS, $feedback, 200);
    }
}
