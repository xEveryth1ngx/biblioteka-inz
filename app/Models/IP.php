<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IP extends Model
{
    use HasFactory;

    protected $table = 'ips';

    protected $fillable = [
        'ip',
    ];

    public function siteEntrance(): HasMany
    {
        return $this->hasMany(SiteEntrance::class);
    }
}
