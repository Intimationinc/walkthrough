<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\SubjectController;
use App\Http\Requests\SubjectStoreRequest;
use App\Models\Subject;
use App\Services\SubjectService;
use App\Transformers\SubjectListTransformer;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;
use Spatie\Fractal\Facades\Fractal;
use Tests\TestCase;

class SubjectControllerTest extends TestCase
{
    use WithFaker;

    public function test_index_method_returns_subjects()
    {
        $subject1 = new Subject();
        $subject1->subject = "Math";
        $subject2 = new Subject();
        $subject2->subject = "Bangla";
        $mockSubjects = [$subject1, $subject2];

        $subjectServiceMock = $this->createMock(SubjectService::class);

        $paginatedData = $subjectServiceMock->expects($this->once())->method('getSubjects')->willReturn(new LengthAwarePaginator($mockSubjects, 4, 2));

        Fractal::shouldReceive('collection')->with($paginatedData);
        Fractal::shouldReceive('transformWith')->with(SubjectListTransformer::class);
        Fractal::shouldReceive('paginateWith');

        $subjectController = new SubjectController($subjectServiceMock);

        $response = $subjectController->index();

        $this->assertEquals($response->getData()->data[0]?->subject, $mockSubjects[0]->subject);
        $this->assertEquals($response->getData()->data[1]?->subject, $mockSubjects[1]->subject);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
