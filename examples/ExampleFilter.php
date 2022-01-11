<?php


namespace AttiaAhmed\ExtendableAction\Examples;

use AttiaAhmed\ExtendableAction\Filter;

class ExampleFilter extends Filter
{

    public function apply(array $args): array
    {

        $args["name"] = "Mr. ".$args["name"];
        return $args;
    }
}