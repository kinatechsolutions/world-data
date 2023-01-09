<?php

namespace Kinatech\World\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $guarded = [];

    public static mixed $key = ["iso2"];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'country_code', 'iso2');
    }

    public function states(): HasMany
    {
        return $this->hasMany(State::class, 'country_code', 'iso2');
    }

    public function counties(): HasMany
    {
        return $this->hasMany(State::class, 'country_code', 'iso2')->whereNotNull('county_code');
    }
}
