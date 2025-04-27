<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function members()
    {
        return $this->hasMany(ProjectMember::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_members')
                    ->withPivot('role_in_project');
    }
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
