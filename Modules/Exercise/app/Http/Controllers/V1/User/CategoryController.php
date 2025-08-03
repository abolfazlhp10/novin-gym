<?php

namespace Modules\Exercise\Http\Controllers\V1\User;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Exercise\Classes\V1\ResponseMessages;
use Modules\Exercise\Services\V1\CategoryService;
use Modules\Exercise\Transformers\V1\CategoryCollection;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService, private ApiResponse $apiResponse) {}
    public function index(): JsonResponse
    {
        $categories = new CategoryCollection($this->categoryService->getAll());
        return $this->apiResponse->successResponse(ResponseMessages::GET_ALL_CATEGORY_SUCCESS, $categories, 200);
    }
}
