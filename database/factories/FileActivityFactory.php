<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\File;
use App\Models\FileActivity;
use App\Models\User;

class FileActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FileActivity::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'file_id' => File::factory(),
            'user_id' => User::factory(),
            'action' => fake()->word(),
            'details' => fake()->word(),
        ];
    }
}
