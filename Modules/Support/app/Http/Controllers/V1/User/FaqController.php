<?php

namespace Modules\Support\Http\Controllers\V1\User;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Support\Models\Faq;
use Modules\Support\app\Classes\V1\ResponseMessages;

class FaqController extends Controller
{
    public function __construct(private ApiResponse $apiResponse) {}

    public function index(): JsonResponse
    {
        $faqs = Faq::all();
        return $this->apiResponse->successResponse(ResponseMessages::GET_ALL_FAQS_SUCCESS, $faqs, 200);
    }
}
