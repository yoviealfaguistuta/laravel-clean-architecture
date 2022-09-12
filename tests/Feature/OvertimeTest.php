<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OvertimeTest extends TestCase
{
    public function test_response_200()
    {
        $faker = Factory::create();
        $response = $this->postJson('/api/overtimes', 
        [
            'employee_id' => 1,
            'date' => $faker->date('Y-m-d'),
            'time_started' => "12:00",
            'time_ended' => "14:00"
        ]);
 
        $response->assertStatus(200);
    }

    public function test_response_422_employe_not_found()
    {
        $faker = Factory::create();
        $response = $this->postJson('/api/overtimes', 
        [
            'employee_id' => -1,
            'date' => $faker->date('Y-m-d'),
            'time_started' => "12:00",
            'time_ended' => "14:00"
        ]);
 
        $response->assertStatus(422)->assertJson([
            'errors' => [
                'employee_id' => [
                    "Employee id yang dipilih tidak valid."
                ]
            ],
            'status' => true
        ]);
    }

    public function test_response_422_time_start_bigger_then_time_end()
    {
        $faker = Factory::create();
        $response = $this->postJson('/api/overtimes', 
        [
            'employee_id' => 1,
            'date' => $faker->date('Y-m-d'),
            'time_started' => "19:00",
            'time_ended' => "14:00"
        ]);
 
        $response->assertStatus(422)->assertJson([
            'errors' => [
                'time_ended' => [
                    "Waktu berakhir harus lebih besar dari waktu dimulai"
                ]
            ],
            'status' => true
        ]);
    }
}
