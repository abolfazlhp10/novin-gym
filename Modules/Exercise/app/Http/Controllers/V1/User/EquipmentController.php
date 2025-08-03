<?php

namespace Modules\Exercise\Http\Controllers\V1\User;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Exercise\Classes\V1\ResponseMessages;
use Modules\Exercise\Services\V1\EquipmentService;
use Modules\Exercise\Transformers\V1\EquipmentCollection;

class EquipmentController extends Controller
{
    public function __construct(private EquipmentService $equipmentService, private ApiResponse $apiResponse) {}
    public function index(): JsonResponse
    {
        $equipments = new EquipmentCollection($this->equipmentService->getAll());
        return $this->apiResponse->successResponse(ResponseMessages::GET_ALL_EQUIPMENTS_SUCCESS, $equipments, 200);
    }
}
