<?php


namespace LibraryApi\Controllers;


class ApiController
{
    protected function getQueryParams()
    {
        return $_SERVER['QUERY_STRING'];
    }


}
