<?php

function statusColor(string|bool $status): string {
    return match ($status) {
        'pending' => 'yellow',
        'active', true  => 'green',
        'failed', false  => 'red',
        default => 'indigo'
    };
}

function statusValue(bool $value): string
{
    return  $value ? 'ACTIVE' : 'INACTIVE';
}
