<?php

namespace App\Helpers;


class General
{
    public static function countTask(bool $is_admin = false): array
    {
        $tasks = !$is_admin ? auth()->user()->tasks() : \App\Models\Task::query();

        $task_count = $tasks->groupBy('status')
            ->selectRaw('count(*) as total, status')
            ->get();;

        $count = [];
        $task_count->each(function ($value) use (&$count) {
            $key = str($value->status)->slug('_')->toString();
            $count[$key] = $value->total;
        });

        return $count;
    }
}
