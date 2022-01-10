<?php


namespace AttiaAhmed\ExtendableAction\Tests\Resources;

use AttiaAhmed\ExtendableAction\Action;

class DummyAction extends Action
{

    /**
     * @inheritDoc
     */
    public function apply($result)
    {
        $result["modified_by"] = get_class($this);

        return $result;
    }
}