<?php

namespace LibraryApi\Modules\Router\SystemMiddleware;

class ApiRouteNotFoundMiddleware extends BaseMiddleware implements ApiRouteNotFoundMiddlewareInterface
{
    public function handle(...$args)
    {
        return $this->response(['error' => 'Route is not found'], 404);
    }

}