<?php

namespace LibraryApi\Modules\Router\SystemMiddleware;

interface ControllerExecutionMiddlewareInterface
{
    public function __construct(callable $action, array $params);

    public function handle(...$args);
}