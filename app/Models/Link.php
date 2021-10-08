<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'alias',
        'owner',
        'deleted'
    ];

    public function clicks(): HasOne
    {
        return $this->hasOne(Clicks::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
