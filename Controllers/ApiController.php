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


    protected function response($data)
    {
        header('Content-Type: application/json');
        return json_encode($data);
    }


}
