<?php

namespace AttiaAhmed\ExtendableAction;

use Illuminate\Support\ServiceProvider;

class ExtendableActionBaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/extendable-action.php' => config_path('extendable-action.php'),
        ], 'extendable-action-config');
    }

}