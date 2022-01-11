<?php


namespace AttiaAhmed\ExtendableAction\Examples;

use AttiaAhmed\ExtendableAction\ExtendableAction;

class ExampleExtendableAction extends ExtendableAction
{
    public function run($name)
    {
        return "Hello " . $name;
    }

}