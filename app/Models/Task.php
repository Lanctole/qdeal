<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status_id', 'due_date'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function scopeTitle($query, $title)
    {
        return $title
            ? $query->where('title', $title)
            : $query;
    }
}
