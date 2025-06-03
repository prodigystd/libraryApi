<?php

namespace LibraryApi\Microkernel\Container;

use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionFunction;
use ReflectionNamedType;

class Container implements ContainerInterface
{
    /**
     * The container's  instance.
     *
     * @var ?static
     */
    protected static ?Container $instance = null;

    /**
     * @var array
     */
    private array $bindings = [];

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    /**
     *   get Singleton instance of the class
     *
     * @return static
     */
    public static function instance(): Container
    {
        if (!static::$instance) {
            static::$instance = new static;
        }

        return static::$instance;
    }


    /**
     * @param $abstractClass
     * @param $concreteClassOrObject
     * @return void
     */
    public function bind($abstractClass, $concreteClassOrObject): void
    {
        $this->bindings[$abstractClass] = $concreteClassOrObject;
    }


    /**
     * instantiate class with dependency and return class instance
     * @param $class - class name
     * @param array $parameters (optional) -- parameters as array . If constructor need any parameter
     * @throws ReflectionException
     */
    public function make($class, array $parameters = []): mixed
    {
        $boundClass = $this->getBoundClass($class);
        if (is_object($boundClass)) {
            return $boundClass;
        }
        $reflectionClass = new ReflectionClass($boundClass);
        $constructor = $reflectionClass->getConstructor();
        $dependencies = [];
        if ($constructor) {
            $dependencies = $this->resolveParams($constructor->getParameters(), $parameters);
        }

        return $reflectionClass->newInstance(...$dependencies);
    }

    /**
     * Call a function with dependency and return function result
     * @param callable $function
     * @param array $parameters
     * @return mixed
     * @throws ReflectionException
     */
    public function call(callable $function, array $parameters = []): mixed
    {
        $reflectionFunction = new ReflectionFunction($function(...));

        $dependencies = $this->resolveParams($reflectionFunction->getParameters(), $parameters);
        return $function(...$dependencies);
    }

    private function resolveParams(array $params, array $predefinedParamValues): array
    {
        $dependencies = [];
        foreach ($params as $param) {

            $name = $param->getName();
            if (array_key_exists($name, $predefinedParamValues)) {
                $dependencies[] = $predefinedParamValues[$name];
                continue;
            }

            if ($this->checkIfParamCanBeInstantiated($param)) {
                $dependencies[] = $this->make($param->getType()->getName());
                continue;
            }

            if (!$param->isOptional()) {
                throw new Exception("Can not resolve parameters");
            }

        }

        return $dependencies;
    }

    private function checkIfParamCanBeInstantiated(\ReflectionParameter $parameter): bool
    {
        $type = $parameter->getType();

        if (!($type instanceof ReflectionNamedType)) {
            return false;
        }

        if ($type->isBuiltin()) {
            return false;
        }

        return true;
    }


    private function getBoundClass(string $className): string|object
    {
        if (isset($this->bindings[$className])) {
            return $this->bindings[$className];
        }
        return $className;
    }

}
