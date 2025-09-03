<?php
namespace Modules\Support\Http\Controllers\V1\User;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Support\app\Classes\V1\ResponseMessages;
use Modules\Support\Http\Requests\V1\FeedbackStoreRequest;
use Modules\Support\Models\Feedback;

class FeedbackController extends Controller
{
    public function __construct(private ApiResponse $apiResponse)
    {}

    public function store(FeedbackStoreRequest $request): JsonResponse
    {
        $feedback = Feedback::create([
            'user_id'  => auth()->user()->id,
            'feedback' => $request->feedback,
        ]);

        return $this->apiResponse->successResponse(ResponseMessages::CREATE_FEEDBACK_SUCCESS, $feedback, 201);
    }
}
