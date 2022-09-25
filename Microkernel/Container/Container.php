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
     * @var static
     */
    protected static $instance;

    /**
     * @var array
     */
    private $bindings = [];

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
        $reflectionClass = new ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();
        if (!$constructor) {
            return $this->createInstance($reflectionClass, $parameters);
        }
        $dependencies = $this->resolveParams($constructor->getParameters(), $parameters);

        // finally pass dependency and param to class instance
        return $this->createInstance($reflectionClass, $dependencies);
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

    private function resolveParams(array $params, array $paramValues): array
    {
        $dependencies = [];
        foreach ($params as $param) {

            $type = $param->getType();

            if ($type && $type instanceof ReflectionNamedType && $type->getName() !== 'callable') {
                // make instance of the param class and push it to $dependencies array
                $dependencies[] = $this->make($type->getName());
            } else {
                $name = $param->getName(); // get the name of param
                // check this param value exist in $parameters
                if (array_key_exists($name, $paramValues)) { // if exist
                    // push  value to $dependencies sequentially
                    $dependencies[] = $paramValues[$name];
                } else { // if not exist
                    if (!$param->isOptional()) { // check if not optional
                        throw new Exception("Can not resolve parameters");
                    }
                }
            }
        }
        return $dependencies;
    }


    /**
     * @param ReflectionClass $reflectionClass
     * @param array $parameters
     * @return object
     * @throws ReflectionException
     */
    private function createInstance(ReflectionClass $reflectionClass, array $parameters = []): object
    {
        $className = $reflectionClass->getName();
        if (isset($this->bindings[$className])) {
            $boundClass = $this->bindings[$className];
            if (is_object($boundClass)) {
                return $boundClass;
            }
            $boundReflectionClass = new ReflectionClass($boundClass);
            return $boundReflectionClass->newInstance(...$parameters);
        }
        return $reflectionClass->newInstance(...$parameters);
    }

}
