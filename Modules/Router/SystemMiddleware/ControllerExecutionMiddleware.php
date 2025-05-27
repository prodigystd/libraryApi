<?php

namespace LibraryApi\Modules\Router\SystemMiddleware;

class ControllerExecutionMiddleware extends BaseMiddleware
{
    private $action;
    private array $params;
    public function __construct(callable $action, array $params)
    {
        $this->action = $action;
        $this->params = $params;
    }

    public function handle(...$args)
    {
        return call_user_func($this->action, ...$this->params);
    }

}