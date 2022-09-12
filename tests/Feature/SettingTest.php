<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingTest extends TestCase
{
    public function test_response_200()
    {
        $response = $this->patchJson('/api/settings', 
        [
            'key' => 'overtime_method', 
            'value' => 2
        ]);
 
        $response->assertStatus(200);
    }

    public function test_response_422_validation()
    {
        $response = $this->patchJson('/api/settings', 
        [
            'key' => 'method_overtime', 
            'value' => 3
        ]);
 
        $response->assertStatus(422)->assertJson([
            'errors' => [
                'key' => [
                    "Key harus berupa 'overtime_method'"
                ],
                'value' => [
                    "Relasi pada tabel references tidak ditemukan"
                ]
            ],
            'status' => true
        ]);
    }

    public function test_no_update_with_same_data()
    {
        $response = $this->patchJson('/api/settings', 
        [
            'key' => 'overtime_method', 
            'value' => 1
        ]);
 
        $response->assertStatus(200)->assertJson([
            'body' => 1
        ]);
    }
}
