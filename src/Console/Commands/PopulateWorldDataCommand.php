<?php

namespace Kinatech\World\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Kinatech\World\Models\City;
use Kinatech\World\Models\Country;
use Kinatech\World\Models\Currency;
use Kinatech\World\Models\Language;
use Kinatech\World\Models\PostalCode;
use Kinatech\World\Models\State;

class PopulateWorldDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'world:populate {type=sql}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate world models with data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            $extension = $this->argument('type');

            $data = [
                Currency::class => __DIR__ . "/../../Data/currencies." . $extension,
                Language::class => __DIR__ . "/../../Data/languages." . $extension,
                Country::class => __DIR__ . "/../../Data/countries." . $extension,
                State::class => __DIR__ . "/../../Data/states." . $extension,
                City::class => __DIR__ . "/../../Data/cities." . $extension,
                PostalCode::class => __DIR__ . "/../../Data/postal_codes." . $extension,
            ];

            $count = 1;

            $this->comment('Starting');

            $progress = $this->output->createProgressBar(count($data));
            $progress->start();

            foreach ($data as $model => $list) {

                if ($extension === 'sql') {

                    $dbUser = env('DB_USERNAME');
                    $dbPassword = env('DB_PASSWORD');
                    $dbName = env('DB_DATABASE');

                    exec("mysql -u  $dbUser --password=$dbPassword  $dbName < $list");

                    $progress->advance();

                    continue;
                }

                $list = json_decode(file_get_contents($list), true);

                foreach ($list as $item) {
                    $modelKeys = [];

                    foreach ($model::$key as $mk) {
                        $modelKeys[$mk] = $item[$mk];
                    }

                    $model = $model::where($modelKeys)->firstOr(function () use ($model) {
                        return new $model();
                    });

                    $model->fill($item);
                    $model->save();

                    $progress->advance();
                }

                $progress->finish();

                $count++;
            }

            $this->line('');
            $this->comment('Completed');

            return static::SUCCESS;

        } catch (\Exception $exception) {
            $this->error(Str::limit($exception->getMessage(), 100) . "....");
            return static::FAILURE;
        }
    }
}
