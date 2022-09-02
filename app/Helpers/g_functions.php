<?php

function statusColor(string|bool $status): string {
    return match ($status) {
        'pending', 'PENDING' => 'yellow',
        'active', 'DONE', true  => 'green',
        'failed', false, 'OVERDUE'  => 'red',
        default => 'indigo'
    };
}

function statusValue(bool $value): string
{
    return  $value ? 'ACTIVE' : 'INACTIVE';
}

/*
 * Generate a unique slug
 */
function genUniqueSlug(string $value)
{
    $slug = str($value)->substr(0, 12)->slug();
    $rand = str(rand(111111, 999999))->toString();
    $rand_array = [substr($rand, 0, 2), substr($rand, 2, 2), substr($rand, 4, 2)];

    $slug = str_replace($rand_array, ' ', $slug) . $rand;

    return str_shuffle($slug);
}

function isAdmin(\App\Models\User $user = null): bool
{
    $user = $user ?? auth()->user();

    return $user->role == 'admin';
}
