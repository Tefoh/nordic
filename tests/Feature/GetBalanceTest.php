<?php

namespace Tests\Feature;

use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetBalanceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function get_balance_of_user_should_return_correct_response_with_valid_data()
    {
        Wallet::factory()->create([
            'user_id' => 2,
            'amount' => 1000
        ]);

        $data = ['user_id' => 2];
        $response = $this->get(route('get-balance'), $data)->json();

        $this->assertEquals(1000, $response['balance']);

        Wallet::factory()->create([
            'user_id' => 2,
            'amount' => -600
        ]);

        $data = ['user_id' => 2];
        $response = $this->get(route('get-balance'), $data)->json();

        $this->assertEquals(400, $response['balance']);

        Wallet::factory()->create([
            'user_id' => 2,
            'amount' => 200
        ]);

        $data = ['user_id' => 2];
        $response = $this->get(route('get-balance'), $data)->json();

        $this->assertEquals(600, $response['balance']);
    }
    /**
     * @test
     */
    public function get_balance_of_user_should_throw_error_if_user_not_found()
    {
        $data = ['user_id' => 2];
        $this->get(route('get-balance'), $data)
            ->assertStatus(404);
    }
}
