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

    /**
     * @var array
     */
    protected array $configs = [];


    protected string $method = 'run';


    public function __construct()
    {
        $this->configs = $this->getActionConfigs();


    }

    /**
     * @return array
     */
    protected function getActionConfigs(): array
    {

        return config($this->getConfigName(), []);
    }

    /**
     * @return String
     */
    protected function getConfigName()
    {

        return "extendable-action." . get_class($this);
    }

    /**
     * @param mixed ...$args
     * @return mixed
     * @throws ReflectionException
     */
    public function __invoke(...$args)
    {
        $params = $this->convertToNamedParams($args);

        $params = $this->applyFilters($params);
        $result = call_user_func_array([$this, $this->method], $params);

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

        return $this->configs["filters"] ?? [];
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

        return $this->configs["actions"] ?? [];
    }

    public function __call(string $name, array $arguments)
    {
        if ($name == $this->method) {
            throw new Exception("undefined abstract function \"{$name}\"");
        }
        throw new Exception("undefined abstract function \"{$name}\"");
    }


}