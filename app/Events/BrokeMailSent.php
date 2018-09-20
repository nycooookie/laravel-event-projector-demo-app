<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class BrokeMailSent implements ShouldBeStored
{
    /** @var string */
    public $id;

    public function __construct(int $id)
    {
        $this->id= $id;
    }
}
