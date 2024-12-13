<?php
namespace App\Services;

use App\Caches\SubjectCache;
use App\Contracts\SubjectRepository;

class SubjectService
{
    public function __construct(protected SubjectRepository $subjectRepository)
    {}

    public function getSubjects()
    {
        return SubjectCache::get();
    }

    public function createSubject(array $subjectData)
    {
        $this->subjectRepository->createSubject($subjectData);
    }
}