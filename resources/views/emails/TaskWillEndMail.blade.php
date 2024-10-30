<h1>Hi {{ $task->user->name }},</h1>
<p>Your task "{{ $task->name }}" will end in the next 3 days ({{ $task->end_date }})</p>
<p>Make sure to complete it</p>