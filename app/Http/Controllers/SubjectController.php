<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Http\Requests\SubjectStoreRequest;
use App\Services\SubjectService;
use App\Transformers\SubjectListTransformer;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class SubjectController extends Controller
{
    use ApiResponse;
    public function __construct(protected SubjectService $subjectService)
    {}

    public function index()
    {
        $subjects = $this->subjectService->getSubjects();

        $data = fractal()->collection($subjects)->transformWith(SubjectListTransformer::class)
            ->paginateWith(new IlluminatePaginatorAdapter($subjects))->toArray();

        return ApiResponse::success($data);
    }

    public function store(SubjectStoreRequest $subjectServiceRequest)
    {
        $this->subjectService->createSubject($subjectServiceRequest->validated());
        return ApiResponse::success(message:'Subject created successfully', code:201);
    }
}
