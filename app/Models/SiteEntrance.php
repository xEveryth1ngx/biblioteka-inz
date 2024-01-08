<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiteEntrance extends Model
{
    use HasFactory;

    public function ip(): BelongsTo
    {
        return $this->belongsTo(Ip::class);
    }
}
