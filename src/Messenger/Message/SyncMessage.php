<?php

declare(strict_types=1);

namespace App\Messenger\Message;

class SyncMessage 
{

    private string $data;


    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
