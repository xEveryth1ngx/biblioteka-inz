<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
    ];

    public function click(): HasMany
    {
        return $this->hasMany(Click::class);
    }

    public function mouseHover(): HasMany
    {
        return $this->hasMany(MouseHover::class);
    }

    public function scroll(): HasMany
    {
        return $this->hasMany(Scroll::class);
    }
}
