<?php


namespace AttiaAhmed\ExtendableAction;

use Closure;

abstract class Action
{

    protected array $parameters = [];

    public function handle($data, Closure $next)
    {
        $this->parameters = $data["parameters"];
        $data["result"] = $this->apply($data["result"]);
        return $next($data);
    }

    /**
     * @param mixed $result
     * @return mixed
     */
    public abstract function apply($result);


}