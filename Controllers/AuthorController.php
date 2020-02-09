<?php

namespace LibraryApi\Controllers;




class AuthorController extends ApiController
{

    public function byAuthor()
    {
        echo 'getQueryParams' . $this->getQueryParams() . PHP_EOL;
        return 'Successfully called byAuthor()';
    }


}
