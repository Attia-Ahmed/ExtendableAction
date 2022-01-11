<?php


namespace AttiaAhmed\ExtendableAction\Examples;

use AttiaAhmed\ExtendableAction\Action;

class ExampleAction extends Action
{

    /**
     * @inheritDoc
     */
    public function apply($result)
    {
        return "<h1>{$result}</h1>";
    }
}