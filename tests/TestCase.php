<?php

namespace AttiaAhmed\ExtendableAction\Tests;


use AttiaAhmed\ExtendableAction\ExtendableActionAppServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function setConfigs(array $config)
    {
        $this->app->singleton("extendable-actions-configs", function () use ($config){
            return $config;
        });
    }
}