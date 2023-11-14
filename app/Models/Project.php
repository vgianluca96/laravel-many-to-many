<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'type_id', 'github_link', 'internet_link', 'description', 'preview', 'slug'];


    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
