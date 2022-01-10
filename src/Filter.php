<?php


namespace AttiaAhmed\ExtendableAction;

use Closure;

abstract class Filter
{

    public function handle(array $args, Closure $next)
    {
        return $next($this->apply($args));
    }

    public abstract function apply(array $args): array;


}