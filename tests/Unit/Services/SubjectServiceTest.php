<?php

namespace Tests\Unit\Services;

use App\Caches\SubjectCache;
use App\Contracts\SubjectRepository;
use App\Services\SubjectService;
use Mockery;
use PHPUnit\Framework\TestCase;

class SubjectServiceTest extends TestCase
{
    protected $subjectRepositoryMock;
    protected $subjectCacheMock;
    protected $subjectService;

    protected function setUp(): void
    {
        $this->subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $this->subjectService = new SubjectService($this->subjectRepositoryMock);
    }

    public function testGetSubjectsReturnsCache()
    {
        $fakeSubjects = ['Math', 'Science', 'History'];
        Mockery::mock('alias:' . SubjectCache::class)
            ->shouldReceive('get')
            ->once()
            ->andReturn($fakeSubjects);

        $result = $this->subjectService->getSubjects();
        $this->assertEquals($fakeSubjects, $result);
    }

    public function testCreateSubjectCallsRepository()
    {

        $subjectData = ['subject' => 'Math'];
        $this->subjectRepositoryMock
            ->expects($this->once())
            ->method('createSubject')
            ->with($this->equalTo($subjectData));
        $this->subjectService->createSubject($subjectData);
    }
}
