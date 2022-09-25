<?php

namespace LibraryApi\Microkernel\Container;


use ReflectionException;

interface ContainerInterface
{
    /**
     * Binding class for container
     * @param $abstractClass - interface or class to bind
     * @param $concreteClassOrObject - class to instantiate or existing object
     * @return void
     */
    public function bind($abstractClass, $concreteClassOrObject): void;

    /**
     * Creating object using container
     * @param $class - interface or class
     * @param array $parameters
     * @return object
     */
    public function make($class, array $parameters = []): mixed;

    /**
     * Call a function with dependency and return function result
     * @param callable $function
     * @param array $parameters
     * @return mixed
     * @throws ReflectionException
     */
    public function call(callable $function, array $parameters = []): mixed;
}