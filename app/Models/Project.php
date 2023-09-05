<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'id_created_by'
    ];

    /**
     * Each Project belongs to an User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_created_by', 'id');
    }
}
