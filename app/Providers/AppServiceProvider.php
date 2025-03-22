<?php

namespace App\Providers;

use App\Models\Package;
use App\Models\User;
use Carbon\CarbonImmutable;
use Github\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this
            ->configureMorphMaps()
            ->configureModels()
            ->configureUrls()
            ->configureCommands()
            ->configureDates()
            ->configureTelescope()
            ->configureGitHubClient();
    }

    private function configureMorphMaps(): self
    {
        Relation::enforceMorphMap([
            'user' => User::class,
            'package' => Package::class,
        ]);

        return $this;
    }

    private function configureModels(): self
    {
        Model::shouldBeStrict(! app()->isProduction());

        return $this;
    }

    private function configureUrls(): self
    {
        if (app()->isProduction()) {
            URL::forceScheme('https');
        }

        return $this;
    }

    private function configureCommands(): self
    {
        // DB::prohibitDestructiveCommands(
        //     app()->isProduction()
        // ); will reenable this when we actually have a production server

        return $this;
    }

    private function configureDates(): self
    {
        Date::use(CarbonImmutable::class);

        return $this;
    }

    private function configureTelescope(): self
    {
        if ($this->app->environment('local') && class_exists(TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        return $this;
    }

    private function configureGitHubClient(): self
    {
        $this->app->singleton(Client::class, function ($app) {
            $client = new Client;

            return $client;
        });

        return $this;
    }
}
