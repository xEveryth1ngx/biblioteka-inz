<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Click extends Model
{
    use HasFactory;

    protected $fillable = [
        'element_type',
        'element_id',
        'element_classes',
        'y_axis',
        'x_axis',
        'width',
        'height',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
