<?php

namespace LibraryApi\Resources;

class JsonResource
{
    public function __construct(protected array $data)
    {

    }

    public function serialize(): array
    {
        return ['data' => $this->data];
    }

}