<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use App\Models\Task;
use App\Mail\TaskWillEndMail;

class CheckTasksStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // 3 days before task end_date
        $tasks = Task::whereDate('end_date', '=', Carbon::now()->addDays(3))->get();

        // sending for every task
        foreach ($tasks as $task) {
            Mail::to($task->user->email)->send(new TaskReminderMail($task));
        }

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
