<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{

    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            // 列名name->title
            'name' => $this->faker->word(),
            'deadline'=> $this->faker->dateTimeBetween('now', '1month'),
            'created_at'=> $this->faker->dateTimeBetween('-1month', 'now'),
            'status' => $this->faker->boolean()
        ];
    }
}

// state:状態別にデータ定義
// [ファクトリの状態]
// public function definition()
// {
//     ...
// }
 
// public function completed()
// {
//     return $this->state(fn () => ['status' => true]);
// }
 
// public function notCompleted()
// {
//     return $this->state(fn () => ['status' => false]);
// }
 
// 使い方(in Seeder)
// $dummyCompletedTask = Task::factory()->completed()->create();
// $dummyNoCompletedTask = Task::factory()->notCompleted()->create();