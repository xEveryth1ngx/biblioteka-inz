<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Scroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'max_scroll',
        'page_id',
        'ip_id',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
