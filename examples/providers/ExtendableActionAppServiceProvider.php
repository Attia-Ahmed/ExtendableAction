<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use AttiaAhmed\ExtendableAction\Examples\ExampleFilter;
use AttiaAhmed\ExtendableAction\Examples\ExampleAction;
use AttiaAhmed\ExtendableAction\Examples\ExampleExtendableAction;

class ExtendableActionAppServiceProvider extends ServiceProvider
{
    /**
     *  Extendable Actions Configuration
     *
     *  You should fill @var array $extendable_action to map ExtendableActions to their Filters and Actions.
     *
     * @link  https://github.com/Attia-Ahmed/ExtendableAction#usage
     */
    protected array $extendable_actions = [

        ExampleExtendableAction::class => [
            "filters" => [
                ExampleFilter::class
            ],
            "actions" => [
                ExampleAction::class
            ]
        ],
    ];

    public function boot()
    {
        $this->app->singleton("extendable-actions-configs", function () {
            return $this->extendable_actions;
        });
    }

    public function register()
    {
    }


}