<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddMoneyTest extends TestCase
{
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
}
