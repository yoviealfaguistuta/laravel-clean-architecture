<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    public function test_response_200()
    {
        $faker = Factory::create();
        $response = $this->postJson('/api/employees', 
        [
            'name' => $faker->firstname(),
            'salary' => 5000000
        ]);
 
        $response->assertStatus(200);
    }

    public function test_response_422_min_salary()
    {
        $faker = Factory::create();
        $response = $this->postJson('/api/employees', 
        [
            'name' => $faker->firstname(),
            'salary' => 100000
        ]);
 
        $response->assertStatus(422)->assertJson([
            'errors' => [
                'salary' => [
                    "Gaji harus lebih dari 2000000"
                ]
            ],
            'status' => true
        ]);
    }

    public function test_response_422_max_salary()
    {
        $faker = Factory::create();
        $response = $this->postJson('/api/employees', 
        [
            'name' => $faker->firstname(),
            'salary' => 10000001
        ]);
 
        $response->assertStatus(422)->assertJson([
            'errors' => [
                'salary' => [
                    "Gaji tidak boleh lebih dari 10000000"
                ]
            ],
            'status' => true
        ]);
    }

    public function test_response_422_string_salary()
    {
        $faker = Factory::create();
        $response = $this->postJson('/api/employees', 
        [
            'name' => $faker->firstname(),
            'salary' => "string"
        ]);
 
        $response->assertStatus(422)->assertJson([
            'errors' => [
                'salary' => [
                    "Salary harus berupa bilangan bulat."
                ]
            ],
            'status' => true
        ]);
    }
}
