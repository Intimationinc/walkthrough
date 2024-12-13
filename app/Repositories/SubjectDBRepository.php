<?php

namespace App\Repositories;

use App\Contracts\SubjectRepository;
use App\Exceptions\DatabaseException;
use App\Models\Subject;
use Throwable;

class SubjectDBRepository implements SubjectRepository
{   
    public function __construct(protected Subject $subject)
    {

    }

    public function createSubject(array $subjectData)
    {
        try{
            $this->subject->subject =  $subjectData['subject'];
            $this->subject->save();
        }catch(Throwable $e){
            throw new DatabaseException("Could not create subject");
        }
    }
}