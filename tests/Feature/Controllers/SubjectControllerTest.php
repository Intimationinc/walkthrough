<?php

namespace Tests\Feature\Controllers;

use App\Caches\SubjectCache;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class SubjectControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_store_method_creates_subject_with_valid_data()
    {
        $data = [
            'subject' => 'Mathematics',
        ];

        $response = $this->postJson(route('subjects.store'), $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('subjects', $data);
    }

    public function test_store_method_fails_with_invalid_data()
    {
        $data = [
            'subject' => '',
        ];

        $response = $this->postJson(route('subjects.store'), $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['subject']);
    }
}
