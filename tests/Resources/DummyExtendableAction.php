<?php


namespace AttiaAhmed\ExtendableAction\Tests\Resources;

use AttiaAhmed\ExtendableAction\ExtendableAction;

class DummyExtendableAction extends ExtendableAction
{
    public function run(int $input)
    {
        return ["my_input"    => $input,
                "modified_by" => get_class($this)];
    }
    
}