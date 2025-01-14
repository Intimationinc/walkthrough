<?php

namespace App\Transformers;

use App\Models\Subject;
use League\Fractal\TransformerAbstract;

class SubjectListTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Subject $subject)
    {
        return [
            'subject' => $subject->subject
        ];
    }
}
