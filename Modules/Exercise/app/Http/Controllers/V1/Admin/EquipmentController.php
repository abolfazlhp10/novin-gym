<?php

namespace Modules\Exercise\Http\Controllers\V1\Admin;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Modules\Exercise\Classes\V1\ResponseMessages;
use Modules\Exercise\Http\Requests\V1\StoreEquipmentRequest;
use Modules\Exercise\Http\Requests\V1\UpdateEquipmentRequest;
use Modules\Exercise\Models\V1\Equipment;
use Modules\Exercise\Services\V1\EquipmentService;
use Modules\Exercise\Transformers\V1\EquipmentResource;

class EquipmentController extends Controller
{
    public function __construct(private EquipmentService $equipmentService, private ApiResponse $apiResponse) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipments = $this->equipmentService->getAll();

        return $this->apiResponse->successResponse(ResponseMessages::GET_ALL_EQUIPMENTS_SUCCESS, EquipmentResource::collection($equipments), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipmentRequest $request)
    {
        $equipment = new EquipmentResource($this->equipmentService->create($request->validated()));

        return $this->apiResponse->successResponse(ResponseMessages::CREATE_EQUIPMENT_SUCCESS, $equipment, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show(Equipment $equipment)
    {
        $equipment = new EquipmentResource($equipment);

        return $this->apiResponse->successResponse(ResponseMessages::GET_EQUIPMENT_SUCCESS, $equipment, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        $equipment = new EquipmentResource($this->equipmentService->update($equipment, $request->validated()));

        return $this->apiResponse->successResponse(ResponseMessages::UPDATE_EQUIPMENT_SUCCESS, $equipment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $this->equipmentService->delete($equipment);

        return $this->apiResponse->successResponse(ResponseMessages::DELETE_EQUIPMENT_SUCCESS, [], 200);
    }
}
