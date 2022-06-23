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
     * namespace  for  class. when pass class and method as string
     *
     * @var string
     */
    protected $namespace = "LibraryApi\Controllers\\";


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
        $classReflection = new ReflectionClass($this->namespace . $class);
        $constructorParams = $classReflection->getConstructor()->getParameters();
        $dependencies = [];

        /*
         * loop with constructor parameters or dependency
         */
        foreach ($constructorParams as $constructorParam) {

            $type = $constructorParam->getType();

            if ($type && $type instanceof ReflectionNamedType) {
                // make instance of this class :
                $paramClassName = $constructorParam->getClass()->name;
                if (isset(Bindings::$bindings[$paramClassName])) {
                    $paramClassReflection = new ReflectionClass(Bindings::$bindings[$paramClassName]);
                    $paramInstance = $paramClassReflection->newInstance();
                } else {
                    $paramInstance = $constructorParam->getClass()->newInstance();
                }

                // push to $dependencies array
                $dependencies[] = $paramInstance;

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
        return $classReflection->newInstance(...$dependencies);
    }

}
