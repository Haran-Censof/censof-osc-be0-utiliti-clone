<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Hash;

class InternalUser extends Model
{
    use HasFactory;

    protected $table = 'osc_slg_user';

    protected $fillable = [
        'user_id',
        'user_group_id',
        'user_name',
        'user_email',
        'user_password',
        'user_status',
        'user_created',
        'user_pelangganid',
        'user_iuser',
        'user_uuser',
        'force_password_reset',
        'full_name',
        'role',
        'majlis_code',
        'majlis_id',
        'agency_code',
    ];

    protected $hidden = [
        'user_password',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'user_created' => 'datetime',
        'force_password_reset' => 'boolean',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id')
            ->withPivot('assigned_at', 'assigned_by')
            ->withTimestamps();
    }

    public function setUserPasswordAttribute(string $value): void
    {
        if (strlen($value) !== 60 || !str_starts_with($value, '$2y$')) {
            $this->attributes['user_password'] = Hash::make($value);
            return;
        }

        $this->attributes['user_password'] = $value;
    }
}
