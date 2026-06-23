<?php

namespace Modules\Support\Http\Controllers\V1\Admin;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Support\app\Classes\V1\ResponseMessages;
use Modules\Support\Http\Requests\V1\FaqStoreRequest;
use Modules\Support\Models\Faq;

class FaqController extends Controller
{
    public function __construct(private ApiResponse $apiResponse) {}

    public function index(): JsonResponse
    {
        $faqs = Faq::all();

        return $this->apiResponse->successResponse(ResponseMessages::GET_ALL_FAQS_SUCCESS, $faqs, 200);
    }

    public function store(FaqStoreRequest $request): JsonResponse
    {
        $faq = Faq::create($request->validated());

        return $this->apiResponse->successResponse(ResponseMessages::CREATE_FAQ_SUCCESS, $faq, 200);
    }

    public function destroy(Faq $faq): JsonResponse
    {
        $faq->delete();

        return $this->apiResponse->successResponse(ResponseMessages::CREATE_FAQ_SUCCESS, [], 200);
    }
}
