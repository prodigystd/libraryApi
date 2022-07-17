<?php


namespace LibraryApi\Controllers;

class ApiController
{
    protected function getQueryParams(): array
    {
        return $_GET;
    }


    protected function getQueryParam(string $param)
    {
        return $_GET[$param] ?? null;
    }


    public function response(array $data, int $code = 200): string
    {
        header('Content-Type: application/json');
        http_response_code($code);
        return json_encode($data);
    }

    public function serialize(array $data): array
    {
        return ['data' => $data];
    }
}
