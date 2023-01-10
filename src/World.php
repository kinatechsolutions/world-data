<?php

namespace Kinatech\World;

use Illuminate\Database\Eloquent\Builder;
use Kinatech\World\Models\City;
use Kinatech\World\Models\Country;
use Kinatech\World\Models\Currency;
use Kinatech\World\Models\Language;
use Kinatech\World\Models\PostalCode;
use Kinatech\World\Models\State;

class World
{
    public function country(): Builder
    {
        return Country::query();
    }

    public function state(): Builder
    {
        return State::query();
    }

    public function city(): Builder
    {
        return City::query();
    }

    public function currency(): Builder
    {
        return Currency::query();
    }

    public function language(): Builder
    {
        return Language::query();
    }

    public function postalCode(): Builder
    {
        return PostalCode::query();
    }
}
