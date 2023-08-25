<?php

namespace Tests\Feature;

use App\Http\Controllers\CodeController;
use App\Models\Codes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CodeGenerationTest extends TestCase
{

    use RefreshDatabase;
    /**
     * Checking the uniqueness of codes.
     */
    public function test_generates_unique_codes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $controller = new CodeController();
        $generatedCodes = [];

        $code1 = $controller->generateUniqueCode($generatedCodes);
        $generatedCodes[] = $code1;

        $code2 = $controller->generateUniqueCode($generatedCodes);
        $generatedCodes[] = $code2;

        $this->assertNotEquals($code1, $code2);
    }
}
