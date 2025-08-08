<?php
namespace Modules\Program\Http\Controllers\V1\Admin;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Program\Classes\V1\ResponseMessages;
use Modules\Program\Services\V1\ProgramService;
use Modules\Program\Transformers\V1\ProgramCollection;

class ProgramController extends Controller
{
    public function __construct(private ProgramService $programService, private ApiResponse $apiResponse)
    {}

    public function index(Request $request)
    {
        // dd($request->user()->roles[0]['name']);
        $programs = new ProgramCollection($this->programService->getAll($request->user()));
        return $this->apiResponse->successResponse(ResponseMessages::GET_ALL_PROGRAMS_SUCCESS, $programs, 200);
    }
}
