<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'image',
        'public',
        'users_id'
    ];

    /**
     * Each Project belongs to an User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
