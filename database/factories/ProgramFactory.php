<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Program;

class ProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Program::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'subscription_price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'oneOff_price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'numOfSubscriber' => $this->faker->numberBetween(-10000, 10000),
            'date' => $this->faker->date(),
            'status' => $this->faker->randomElement(["including",""]),
        ];
    }
}
