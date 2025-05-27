<?php

namespace LibraryApi\Modules\Router\SystemController;

interface ApiControllerInterface
{
    public function response(array $data, int $code = 200): string;

    public function serialize(array $data): array;

}