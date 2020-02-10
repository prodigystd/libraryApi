<?php


namespace LibraryApi\Controllers;


use http\Env\Request;

class ApiController
{
    protected function getQueryParams(): array
    {
        return $_GET;
    }


    protected function getQueryParam(string $param)
    {
        return isset($_GET[$param]) ? $_GET[$param] : null;
    }


    protected function response(array $data, int $code = 200): string
    {
        header('Content-Type: application/json');
        http_response_code($code);
        return json_encode($data);
    }


}
