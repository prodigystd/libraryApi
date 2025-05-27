<?php

namespace LibraryApi\Modules\Router\SystemMiddleware;

use LibraryApi\Modules\Router\SystemController\ApiController;

abstract class BaseMiddleware extends ApiController
{
    private ?BaseMiddleware $next;

    public function setNext(BaseMiddleware $next)
    {
        $this->next = $next;
    }

    public function handle(...$args)
    {
        return $this->next->handle();
    }

}