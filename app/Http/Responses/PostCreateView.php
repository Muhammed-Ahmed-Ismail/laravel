<?php

namespace App\Http\Responses;
use Illuminate\Contracts\Support\Responsable;

class PostCreateView implements Responsable
{
    public array $props;
    public function __construct(array $data = [])
    {
        $this->props = array_merge($this->getDefaultProps(), $data);
    }
    public function toResponse()
    {

    }
}
