<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_code',
        'role_name',
        'hierarchy_level',
        'description',
        'is_active',
        'is_system_role',
    ];

    protected $casts = [
        'hierarchy_level' => 'integer',
        'is_active' => 'boolean',
        'is_system_role' => 'boolean',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permission')
            ->withTimestamps();
    }
}
