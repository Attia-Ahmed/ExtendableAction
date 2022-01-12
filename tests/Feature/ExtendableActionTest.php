<?php

namespace AttiaAhmed\ExtendableAction\Tests\Features;

use AttiaAhmed\ExtendableAction\Tests\TestCase;
use AttiaAhmed\ExtendableAction\Tests\Resources\DummyFilter;
use AttiaAhmed\ExtendableAction\Tests\Resources\DummyAction;
use AttiaAhmed\ExtendableAction\Tests\Resources\DummyExtendableAction;

class ExtendableActionTest extends TestCase
{

    public function test_extendable_action_returns_run_method_results()
    {
        $this->setConfigs([]);

        $dummyExtendableAction = app(DummyExtendableAction::class);

        $this->assertEquals(
            ["my_input"    => 10,
             "modified_by" => DummyExtendableAction::class],
            $dummyExtendableAction(10)
        );
    }

    public function test_filter_alert_parameters_for_extendable_action()
    {
        $this->setConfigs([
            DummyExtendableAction::class => [
                "filters" => [DummyFilter::class]
            ]]);
        $dummyExtendableAction = app(DummyExtendableAction::class);

        $this->assertEquals(
            ["my_input"    => 11,
             "modified_by" => DummyExtendableAction::class],
            $dummyExtendableAction(10)
        );
    }

    public function test_chaining_filters()
    {
        $this->setConfigs([
            DummyExtendableAction::class => [
                "filters" => [
                    DummyFilter::class,
                    DummyFilter::class
                ]
            ]]);
        $dummyExtendableAction = app(DummyExtendableAction::class);

        $this->assertEquals(
            ["my_input"    => 12,
             "modified_by" => DummyExtendableAction::class],
            $dummyExtendableAction(10)
        );
    }

    public function test_action_modifies_result_of_extendable_action()
    {
        $this->setConfigs([
            DummyExtendableAction::class => [
                "actions" => [DummyAction::class]
            ]]);

        $dummyExtendableAction = app(DummyExtendableAction::class);

        $this->assertEquals(
            ["my_input"    => 10,
             "modified_by" => DummyAction::class],
            $dummyExtendableAction(10)
        );
    }


    public function test_combine_filters_with_actions()
    {
        $this->setConfigs([
            DummyExtendableAction::class => [
                "filters" => [DummyFilter::class],
                "actions" => [DummyAction::class]
            ]]);

        $dummyExtendableAction = app(DummyExtendableAction::class);

        $this->assertEquals(
            ["my_input"    => 11,
             "modified_by" => DummyAction::class],
            $dummyExtendableAction(10)
        );
    }


}