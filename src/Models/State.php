<?php

namespace Kinatech\World\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    protected $guarded = [];

    public static mixed $key = ["name", "iso2"];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'state_code', 'iso2');
    }
}
