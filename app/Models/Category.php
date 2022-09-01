<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
