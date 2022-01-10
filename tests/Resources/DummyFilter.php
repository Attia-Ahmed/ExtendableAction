<?php


namespace AttiaAhmed\ExtendableAction\Tests\Resources;

use AttiaAhmed\ExtendableAction\Filter;

class DummyFilter extends Filter
{

    public function apply(array $args): array
    {
        ++$args["input"];

        return $args;
    }
}