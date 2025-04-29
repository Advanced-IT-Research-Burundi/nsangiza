<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\File;
use App\Models\SharedFile;
use App\Models\User;

class SharedFileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SharedFile::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'file_id' => File::factory(),
            'shared_by' => User::factory()->create()->shared_by,
            'access_level' => fake()->word(),
        ];
    }
}
