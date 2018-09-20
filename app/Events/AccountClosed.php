<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class AccountClosed implements ShouldBeStored
{
    public $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
