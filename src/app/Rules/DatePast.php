<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;


class DatePast implements Rule
{
    public function passes($attribute, $value)
    {
        $target = new Carbon($value);
        $now = Carbon::now()->toDateTimeString('minute');
        return  $target > $now; 
    }

    public function message()
    {
        return '予約された時間が過ぎています';
    }
}
