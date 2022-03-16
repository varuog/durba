<?php

namespace Database\Factories;

use App\Models\Model;
use Ichtrojan\Otp\Models\Otp;
use Illuminate\Database\Eloquent\Factories\Factory;

class OtpFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Otp::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mobile' => $this->faker->phoneNumber
        ];
    }
}
