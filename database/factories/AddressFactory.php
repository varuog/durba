<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //$user = User::factory()->create();
        return [
            //'user_id' => $user,
            'name' => $this->faker->firstName(), //@todo
            'steert_name' =>$this->faker->streetAddress,
            'building_name' => $this->faker->secondaryAddress,
            'locality' =>$this->faker->streetName,
            'landmark' => $this->faker->sentence(),
            'city' => $this->faker->city,
            'pin_code' => $this->faker->postcode,
            'address_type' => 'home', //@todo
            'contact_mobile' => $this->faker->phoneNumber
        ];
    }
}
