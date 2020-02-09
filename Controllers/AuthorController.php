<?php

namespace LibraryApi\Controllers;

class AuthorController extends ApiController
{

    public function byAuthor()
    {
        var_dump($this->getQueryParams());
        return 'Successfully called byAuthor()';
    }


}
