<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class AccountCreated implements ShouldBeStored
{
    public $id;
    public $accountAttributes;

    public function __construct(array $accountAttributes)
    {
        $this->id = $accountAttributes['id'];

        $this->accountAttributes = $accountAttributes;
    }
}
