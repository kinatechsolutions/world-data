<?php

namespace Kinatech\World\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public static mixed $key = ["name", "state_code", "country_code"];
}
