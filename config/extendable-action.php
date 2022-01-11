<?php


use AttiaAhmed\ExtendableAction\Examples\ExampleAction;
use AttiaAhmed\ExtendableAction\Examples\ExampleFilter;
use AttiaAhmed\ExtendableAction\Examples\ExampleExtendableAction;

return [

    /*
    |--------------------------------------------------------------------------
    | Extendable Actions Configuration
    |--------------------------------------------------------------------------
    |
    | These File is used to extend Actions with filters and actions.
    | the following ExampleExtendableAction is for illustration purposes
    | and should be removed.
    |
    */

    ExampleExtendableAction::class => [
        "filters" => [
            ExampleFilter::class
        ],
        "actions" => [
            ExampleAction::class
        ]
    ],

];