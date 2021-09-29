<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\SteppingStone;

class SteppingStoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SteppingStone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'short_description' => $this->faker->word,
            'description' => $this->faker->text,
            'video_link' => $this->faker->word,
            'pdf_file' => $this->faker->word,
            'audio_file' => $this->faker->word,
            'main_content' => $this->faker->text,
        ];
    }
}
