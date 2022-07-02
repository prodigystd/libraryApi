<?php

namespace LibraryApi\DI;

use Exception;
use ReflectionClass;
use ReflectionNamedType;

class DependencyInjectionContainer
{
    /**
     * The container's  instance.
     *
     * @var static
     */
    protected static $instance;

    /**
     *   get Singleton instance of the class
     *
     * @return static
     */
    public static function instance(): DependencyInjectionContainer
    {
        if (!static::$instance) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * instantiate class with dependency and return class instance
     * @param $class - class name
     * @param array $parameters (optional) -- parameters as array . If constructor need any parameter
     * @throws \ReflectionException
     */
    public function make($class, array $parameters = [])
    {
        $reflectionClass = new ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();
        if (!$constructor) {
            return $this->createInstance($reflectionClass);
        }
        $constructorParams = $constructor->getParameters();
        $dependencies = [];

        /*
         * loop with constructor parameters or dependency
         */
        foreach ($constructorParams as $constructorParam) {

            $type = $constructorParam->getType();

            if ($type && $type instanceof ReflectionNamedType) {
                // make instance of the param class and push it to $dependencies array
                $dependencies[] = $this->createInstance($constructorParam->getClass());

            } else {

                $name = $constructorParam->getName(); // get the name of param

                // check this param value exist in $parameters
                if (array_key_exists($name, $parameters)) { // if exist

                    // push  value to $dependencies sequencially
                    $dependencies[] = $parameters[$name];

                } else { // if not exist

                    if (!$constructorParam->isOptional()) { // check if not optional
                        throw new Exception("Can not resolve parameters");
                    }

                }

            }

        }
        // finally pass dependency and param to class instance
        return $reflectionClass->newInstance(...$dependencies);
    }


    /**
     * @param ReflectionClass $reflectionClass
     * @param array $parameters
     * @return object
     * @throws \ReflectionException
     */
    private function createInstance(ReflectionClass $reflectionClass, array $parameters = [])
    {
        $className = $reflectionClass->getName();
        if (isset(Bindings::$bindings[$className])) {
            $boundReflectionClass = new ReflectionClass(Bindings::$bindings[$className]);
            return $boundReflectionClass->newInstance(...$parameters);
        }
        return $reflectionClass->newInstance(...$parameters);
    }

}
