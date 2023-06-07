<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TotalBillsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'bill_number' => fake()->randomNumber() ,
            'date' => fake()->dateTimeThisCentury() ,
            'item' => fake()->name() ,
            'category' => fake()->name() ,
            'discount' => fake()->latitude(),
            'taxes_value' fake()->latitude(),
            'total' => fake()->latitude(),
            'status' => fake()->name() ,
            'value_status' => fake()->randomNumber(0 ,1),
            'note' => fake()->bs(),
            'user'=> fake()->name(),
        ];
    }
}
