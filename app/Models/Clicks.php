<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Clicks extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id',
        'counter',
    ];

     public function user(): BelongsTo
     {
         return $this->belongsTo(Link::class);
     }
}
