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

    public function setFilters(array $filters): self
    {

        $this->configs["filters"] = $filters;
        return $this;
    }

    public function setActions(array $filters): self
    {

        $this->configs["actions"] = $filters;
        return $this;
    }
}