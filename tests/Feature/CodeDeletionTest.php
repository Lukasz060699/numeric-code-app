<?php

namespace Tests\Feature;

use App\Http\Controllers\CodeController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Codes;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CodeDeletionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Check that the codes are correctly removed from the database.
     */
    public function test_codes_are_deleted()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $codes = ['code1', 'code2', 'code3'];
        foreach ($codes as $code) {
            Codes::create(['code' => $code, 'user_id' => $user->id]);
        }

        foreach ($codes as $code) {
            $this->assertDatabaseHas('codes', ['code' => $code]);
        }
        var_dump($codes);

        $response = $this->delete('/codes', ['codes' => implode(',', $codes)]);
        foreach ($codes as $code) {
            $this->assertDatabaseMissing('codes', ['code' => $code]);
        }

        $response->assertSessionHas('success', 'Kody zostały pomyślnie usunięte');
    }
}
