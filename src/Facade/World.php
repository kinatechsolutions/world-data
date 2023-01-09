<?php


namespace Kinatech\World\Facade;

use Illuminate\Support\Facades\Facade;
use Illuminate\Database\Eloquent\Builder;


/**
 * @method static Builder country()
 * @method static Builder state()
 * @method static Builder city()
 * @method static Builder currency()
 * @method static Builder language()
 */

class World extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'world';
    }
}
