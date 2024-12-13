<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\SubjectStoreRequest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Mockery;
use Tests\TestCase;

class SubjectStoreRequestTest extends TestCase
{
    use WithFaker;

    public function test_subject_store_request_with_valid_data()
    {
        $data = [
            'subject' => 'Mathematics',
        ];

        $request = new SubjectStoreRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes(), 'Validator should pass with valid data.');
    }

    public function test_subject_store_request_with_missing_subject()
    {
        $data = [];

        $request = new SubjectStoreRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes(), 'Validator should fail when subject field is missing.');
        $this->assertArrayHasKey('subject', $validator->errors()->toArray(), 'Error messages should contain subject field.');
    }

    public function test_subject_store_request_with_invalid_subject_type()
    {
        $data = [
            'subject' => 12345,
        ];

        $request = new SubjectStoreRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes(), 'Validator should fail when subject is not a string.');
        $this->assertArrayHasKey('subject', $validator->errors()->toArray(), 'Error messages should contain subject field.');
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
