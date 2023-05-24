<?php

namespace Yormy\AnonymizerLaravel;

use Illuminate\Support\ServiceProvider;
use Yormy\AnonymizerLaravel\Console\Commands\AnonymizeCommand;
use Yormy\AnonymizerLaravel\ServiceProviders\EventServiceProvider;

class AnonymizerServiceProvider extends ServiceProvider
{
    const CONFIG_FILE = __DIR__.'/../config/anonymizer.php';

    /**
     * @psalm-suppress MissingReturnType
     */
    public function boot()
    {
        $this->publish();

        $this->registerCommands();
    }

    /**
     * @psalm-suppress MixedArgument
     */
    public function register()
    {
        $this->mergeConfigFrom(static::CONFIG_FILE, 'anonymizer');

        $this->app->register(EventServiceProvider::class);
    }

    private function publish(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                self::CONFIG_FILE => config_path('anonymizer.php'),
            ], 'config');
        }
    }

    private function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AnonymizeCommand::class,
            ]);
        }
    }
}
