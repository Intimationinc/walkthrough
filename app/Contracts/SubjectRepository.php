<?php

namespace App\Contracts;

interface SubjectRepository
{
    public function createSubject(array $subjectData);
}