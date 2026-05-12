<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Endpoints\TeamEndpoint;
use App\Endpoints\FoundryEndpoint;
use App\Endpoints\CompanyEndpoint;
use App\Endpoints\TermEndpoint;
use App\Endpoints\PostGridFilterEndpoint;
use App\Endpoints\ProgramEndpoint;

class EndpointProvider extends ServiceProvider
{
    protected $endpoints = [
        TeamEndpoint::class,
        FoundryEndpoint::class,
        CompanyEndpoint::class,
        TermEndpoint::class,
        PostGridFilterEndpoint::class,
        ProgramEndpoint::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        add_action('init', [&$this, 'registerEndpoints']);
    }

    /**
     * Register endpoints
     *
     * @return void
     */
    public function registerEndpoints()
    {
        collect($this->endpoints)->each(function ($className) {
            $instance = $this->app->make($className);
            $this->app->singleton($className, function () use ($instance) {
                return $instance;
            });
        });
    }
}
