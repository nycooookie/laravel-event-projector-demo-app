<?php

namespace App;

use App\Events\AccountClosed;
use App\Events\AccountCreated;
use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use DB;

class Account extends Model
{
    protected $guarded = [];

    protected $casts = [
        'broke_mail_send' => 'bool',
    ];

    public static function createWithAttributes(array $attributes): Account
    {
        return DB::transaction(function () use ($attributes) {
            $result = DB::select('show table status where name = ?', ['accounts'])[0];
            $id = $result->Auto_increment;

            $attributes['id'] = $id;

            event(new AccountCreated($attributes));

            return Account::find($id);
        });
    }

    public function addMoney(int $amount)
    {
        event(new MoneyAdded($this->id, $amount));
    }

    public function subtractMoney(int $amount)
    {
        event(new MoneySubtracted($this->id, $amount));
    }

    public function close()
    {
        event(new AccountClosed($this->id));
    }

    public function isBroke(): bool
    {
        return $this->balance < 0;
    }
}
