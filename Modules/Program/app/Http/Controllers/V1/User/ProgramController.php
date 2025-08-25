<?php
namespace Modules\Program\Http\Controllers\V1\User;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Program\Classes\V1\ResponseMessages;
use Modules\Program\Http\Requests\V1\ProgramRequest;
use Modules\Program\Models\V1\Program;
use Modules\Program\Services\V1\ProgramService;
use Modules\Program\Transformers\V1\ProgramResource;
use Spatie\LaravelPdf\Facades\Pdf;

class ProgramController extends Controller
{
    use AuthorizesRequests;

    private $user;

    public function __construct(private ProgramService $programService, private ApiResponse $apiResponse, Request $request)
    {
        $this->user = $request->user();
    }

    public function index() : JsonResponse
    {
        $programs = ProgramResource::collection($this->programService->getAll($this->user));

        return $this->apiResponse->successResponse(ResponseMessages::GET_ALL_PROGRAMS_SUCCESS, $programs, 200);
    }

    public function store(ProgramRequest $request) : JsonResponse
    {
        $program = new ProgramResource($this->programService->create($this->user, $request->validated()));

        return $this->apiResponse->successResponse(ResponseMessages::CREATE_PROGRAM_SUCCESS, $program, 200);
    }

    public function show(Program $program) : JsonResponse
    {
        $this->authorize('show', $program);
        return $this->apiResponse->successResponse(ResponseMessages::GET_PROGRAM_SUCCESS, $program, 200);
    }

    public function download(Program $program)
    {
        $this->authorize('download', $program);

        $file_name = $this->generateSafeFilename($program->user_name . '-' . time());

        return Pdf::view('program::pdf', compact('program'))
            ->format('a4')
            ->name($file_name)
            ->download();
    }

    public function update(Program $program, ProgramRequest $request): JsonResponse
    {
        $this->authorize('update', $program);

        $program = $this->programService->update($program, $request->validated());

        return $this->apiResponse->successResponse(ResponseMessages::UPDATE_PROGRAM_SUCCESS, $program, 200);
    }

    public function destroy(Program $program) : JsonResponse
    {
        $this->authorize('delete', $program);

        $this->programService->delete($program);

        return $this->apiResponse->successResponse(ResponseMessages::DELETE_PROGRAM_SUCCESS, [], 200);

    }

    private function generateSafeFilename(string $name): string
    {
        return preg_replace('/[^\p{L}\p{N}\s_-]/u', '', $name);
    }

}
