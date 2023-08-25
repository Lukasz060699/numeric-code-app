<?php

namespace Tests\Feature;

use App\Http\Controllers\CodeController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Models\User;

class CodeValidationTest extends TestCase
{
    /**
     * Check if the form validation in the store method works correctly.
     */
    public function test_requires_amount_to_be_an_integer()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/codes', ['amount' => 5]);

        $response->assertSessionDoesntHaveErrors(['amount']);
    }
}
