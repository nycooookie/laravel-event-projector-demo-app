<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class MoneySubtracted implements ShouldBeStored
{
    public $id;
    public $amount;

    public function __construct(int $id, int $amount)
    {
        $this->id = $id;

        $this->amount = $amount;
    }
}
