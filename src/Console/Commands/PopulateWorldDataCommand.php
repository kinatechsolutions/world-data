<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Language;
use App\Models\State;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $extension = $this->argument('type');

            $data = [
                Currency::class => __DIR__ . "/../../Data/currencies." . $extension,
                Language::class => __DIR__ . "/../../Data/languages." . $extension,
                Country::class => __DIR__ . "/../../Data/countries." . $extension,
                State::class => __DIR__ . "/../../Data/states." . $extension,
                City::class => __DIR__ . "/../../Data/cities." . $extension,
            ];

            $count = 1;

            $this->comment('Data populations started');

            foreach ($data as $model => $list) {

                $this->info("    " . $count . '. Populating ' . $model);

                if ($extension === 'sql') {

                    $dbUser = env('DB_USERNAME');
                    $dbPassword = env('DB_PASSWORD');
                    $dbName = env('DB_DATABASE');

                    exec("mysql -u  $dbUser -p $dbPassword  $dbName < $list");
                    continue;
                }

                $list = json_decode(file_get_contents($list), true);

                $progress = $this->output->createProgressBar(count($list));
                $progress->setMessage('Populating ' . $model);
                $progress->start();

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

            $this->comment('Populating data completed');

            return Command::SUCCESS;
        } catch (\Exception $exception) {
            $this->error(Str::limit($exception->getMessage(), 100));
        }
    }
}
