<?php
namespace Modules\Exercise\Http\Controllers\V1;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Modules\Exercise\Classes\V1\ResponseMessages;
use Modules\Exercise\Http\Requests\V1\StoreCategoryRequest;
use Modules\Exercise\Http\Requests\V1\UpdateCategoryRequest;
use Modules\Exercise\Models\V1\Category;
use Modules\Exercise\Services\V1\CategoryService;
use Modules\Exercise\Transformers\V1\CategoryCollection;
use Modules\Exercise\Transformers\V1\CategoryResource;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService, private ApiResponse $apiResponse)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = new CategoryCollection($this->categoryService->getAll());
        return $this->apiResponse->successResponse(ResponseMessages::GET_ALL_CATEGORY_SUCCESS, $categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new CategoryResource($this->categoryService->create($request->validated()));
        return $this->apiResponse->successResponse(ResponseMessages::CREATE_CATEGORY_SUCCESS, $category, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show(Category $category)
    {
        $category = new CategoryResource($category);
        return $this->apiResponse->successResponse(ResponseMessages::GET_CATEGORY_SUCCESS, $category, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category = new CategoryResource($this->categoryService->update($category, $request->validated()));
        return $this->apiResponse->successResponse(ResponseMessages::UPDATE_CATEGORY_SUCCESS, $category, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);
        return $this->apiResponse->successResponse(ResponseMessages::DELETE_CATEGORY_SUCCESS, [], 200);
    }
}
