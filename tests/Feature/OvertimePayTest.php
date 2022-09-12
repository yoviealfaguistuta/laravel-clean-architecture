<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OvertimePayTest extends TestCase
{
    public function test_hit_overtime_pay()
    {
        $response = $this->get('api/overtimes-pays/calculate');
 
        $response->assertStatus(200);
    }

    public function test_hit_with_params_overtime_pay()
    {
        $response = $this->get('api/overtimes-pays/calculate?month=2022-01');
 
        $response->assertStatus(200);
    }
}
