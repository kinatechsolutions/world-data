
# World Data

A laravel package that provides listing of world data including, countries, cities, currencies, postal codes and languages.

## Installation

To install this package run

```bash
  composer require kinatechsolutions/world-data
```


Then run migrations to create the database tables.

```bash
 php artisan migrate
```

To populate your models with data run
```bash
 php artisan world:populate
```
## Usage/Examples

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kinatech\World\Facade\World;

class MyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $postalCodes = World::postalCode()
            ->where('country_code', 'KE')
            ->get();

        $countries = World::country()->get();
        $states = World::state()->get();
        $cities = World::city()->get();
        $languages = World::language()->get();
        $currencies = World::currency()->get();
        
        return response()->json([
            'data' => $postalCodes
        ]);
    }
}
```


## Contributing

Contributions are always welcome!

See `contributing.md` for ways to get started.

Please adhere to this project's `code of conduct`.


## Authors

- [@kinare](https://github.com/kinare)


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
