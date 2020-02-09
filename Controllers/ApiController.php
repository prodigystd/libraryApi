<?php


namespace LibraryApi\Controllers;


class ApiController
{
    protected function getQueryParams()
    {
        return $_GET;
    }


    protected function getQueryParam($param)
    {
        return isset($_GET[$param]) ? $_GET[$param] : null;
    }


    protected function response($data, int $code = 200)
    {
        header('Content-Type: application/json');
        http_response_code($code);
        return json_encode($data);
    }


}
