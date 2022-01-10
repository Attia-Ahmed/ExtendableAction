<?php

namespace AttiaAhmed\ExtendableAction\Tests;

use AttiaAhmed\ExtendableAction\Tests\Resources\DummyFilter;
use AttiaAhmed\ExtendableAction\Tests\Resources\DummyAction;
use AttiaAhmed\ExtendableAction\Tests\Resources\DummyExtendableAction;

class ExtendableActionTest extends TestCase
{

    public function test_extendable_action_returns_run_method_results()
    {

        $dummyExtendableAction = app(DummyExtendableAction::class);

        $this->assertEquals(
            ["my_input" => 10,
                "modified_by" => DummyExtendableAction::class],
            $dummyExtendableAction(10)
        );
    }

}