<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title', 
        'body',
        'send_date',
        'is_published',
        'heart_counter'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
