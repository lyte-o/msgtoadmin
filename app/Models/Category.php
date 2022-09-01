<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function resolveRouteBinding($value, $field = null): ?Model
    {
        return $this->where('slug', $value)->firstOrFail();
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function scopeSlug($query, $value)
    {
        return $query->where('slug', $value);
    }
}
