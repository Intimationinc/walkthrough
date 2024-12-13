<?php

namespace Tests\Unit\Repositories;

use App\Exceptions\DatabaseException;
use App\Models\Subject;
use App\Repositories\SubjectDBRepository;
use Exception;
use PHPUnit\Framework\TestCase;

class SubjectDBRepositoryTest extends TestCase
{
    protected $subjectDBRepository;
    protected $subjectMock;

    protected function setUp(): void
    {
        $this->subjectMock = $this->createMock(Subject::class);
        $this->subjectDBRepository = new SubjectDBRepository($this->subjectMock);
    }

    public function testCreateSubjectSuccessfullySavesSubject()
    {
        $subjectData = ['subject' => 'Math'];
        
        $this->subjectMock
            ->expects($this->once())
            ->method('save');

        $this->subjectDBRepository->createSubject($subjectData);
    }

    public function testCreateSubjectHandlesException()
    {
        $subjectData = ['subject' => 'Math'];

        $this->subjectMock
            ->expects($this->once())
            ->method('save')
            ->willThrowException(new Exception('Error saving subject'));

        $this->expectException(DatabaseException::class);

        $this->subjectDBRepository->createSubject($subjectData);
    }
}
