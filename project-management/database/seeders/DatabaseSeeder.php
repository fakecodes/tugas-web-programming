<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Notifications\TaskDeadlineNotification;
use Carbon\Carbon;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

$tasks = Task::where('due_date', '<=', Carbon::now()->addDays(1))->get();
foreach ($tasks as $task) {
    $task->notify(new TaskDeadlineNotification($task));
}
