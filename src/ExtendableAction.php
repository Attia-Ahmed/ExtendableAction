<?php

namespace AttiaAhmed\ExtendableAction;

use Exception;
use ReflectionMethod;
use ReflectionException;
use Illuminate\Pipeline\Pipeline;


/**
 * @Override run
 */
abstract class ExtendableAction
{


    protected string $method = 'run';

    /**
     * @param mixed ...$args
     * @return mixed
     * @throws ReflectionException
     */
    public function __invoke(...$args)
    {
        $params = $this->convertToNamedParams($args);

        $params = $this->applyFilters($params);
        $result = app()->call([$this, $this->method], $params);

        return $this->applyActions($params, $result);


    }

    /**
     * @throws ReflectionException
     */
    protected function convertToNamedParams(array $args): array
    {
        $params = (new ReflectionMethod(get_class($this), $this->method))
            ->getParameters();
        foreach ($params as $param) {
            $position = $param->getPosition();
            if (isset($args[$position])) {
                $args[$param->name] = $args[$position];
                unset($args[$position]);
            }
            if (!isset($args[$param->name]) && $param->isDefaultValueAvailable()) {
                $args[$param->name] = $param->getDefaultValue();
            }
        }

        return $args;

    }

    /**
     * @param array $args
     * @return array
     */
    protected function applyFilters(array $args): array
    {
        return app(Pipeline::class)
            ->send($args)
            ->through($this->getFilters())
            ->thenReturn();
    }

    /**
     * @return array
     */
    protected function getFilters(): array
    {
        return $this->getConfigs()["filters"] ?? [];
    }

    /**
     * @return String
     */
    private function getConfigs(): array
    {
        $configs = app("extendable-actions-configs") ?? [];

        return $configs[get_class($this)] ?? [];
    }

    /**
     * @param mixed $result
     * @return mixed
     */
    protected function applyActions(array $parameters, mixed $result): mixed
    {
        return app(Pipeline::class)
            ->send([
                "parameters" => $parameters,
                "result"     => $result])
            ->through($this->getActions())
            ->thenReturn()["result"];
    }

    /**
     * @return array
     */
    protected function getActions(): array
    {

        return $this->getConfigs()["actions"] ?? [];
    }

    public function __call(string $name, array $arguments)
    {
        if ($name == $this->method) {
            throw new Exception("undefined abstract function \"{$name}\"");
        }
        throw new Exception("undefined abstract function \"{$name}\"");
    }


}