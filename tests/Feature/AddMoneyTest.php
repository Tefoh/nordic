<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddMoneyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_get_payload_with_correct_format_and_necessary_fields()
    {
        $data = [];
        $this->post(route('add-money'), $data)
            ->assertJsonValidationErrorFor('user_id')
            ->assertJsonValidationErrorFor('amount');

        $data = [
            'user_id' => 'string',
            'amount' => 'string',
        ];
        $this->post(route('add-money'), $data)
            ->assertJsonValidationErrorFor('user_id')
            ->assertJsonValidationErrorFor('amount');

        $data = [
            'user_id' => 0,
            'amount' => 50.21,
        ];
        $this->post(route('add-money'), $data)
//            ->assertJsonValidationErrorFor('user_id')
            ->assertJsonValidationErrorFor('amount');
    }

    /**
     * @test
     */
    public function it_should_save_to_database_if_payload_is_correct()
    {
        $data = [
            'user_id' => 2,
            'amount' => 1000,
        ];
        $this->post(route('add-money'), $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('wallets', $data);

        $data = [
            'user_id' => 2,
            'amount' => -500,
        ];
        $this->post(route('add-money'), $data);

        $this->assertDatabaseHas('wallets', $data);
    }

    /**
     * @test
     */
    public function it_should_return_a_correct_response_after_a_successful_request()
    {
        $data = [
            'user_id' => 2,
            'amount' => 1000,
        ];
        $response = $this->post(route('add-money'), $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'reference_id'
            ]);

        $this->assertDatabaseHas('wallets', [
            'reference_id' => $response->json()['reference_id']
        ]);
    }
}
