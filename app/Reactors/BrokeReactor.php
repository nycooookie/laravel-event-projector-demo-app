<?php

namespace App\Reactors;

use App\Account;
use App\Events\BrokeMailSent;
use App\Events\MoneySubtracted;
use App\Mail\BrokeMail;
use Illuminate\Support\Facades\Mail;
use Spatie\EventProjector\EventHandlers\EventHandler;
use Spatie\EventProjector\EventHandlers\HandlesEvents;

class BrokeReactor implements EventHandler
{
    use HandlesEvents;

    public $handlesEvents = [
        MoneySubtracted::class => 'onMoneySubtracted',
    ];

    public function onMoneySubtracted(MoneySubtracted $event)
    {
        $account = Account::find($event->id);

        if (! $account->isBroke()) {
            return;
        }

        if ($account->broke_mail_sent) {
            return;
        }

        Mail::to($account->email)->send(new BrokeMail($account));

        event(new BrokeMailSent($account->id));
    }
}
