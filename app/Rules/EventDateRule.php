<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class EventDateRule implements Rule
{

    protected $event;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->event) {
            return true;
        }
        $dateMin = Carbon::today()->addWeek(2);
        // dd($dateMin);
        // dd(Carbon::createFromFormat("Y-m-d H:i", $value));
        $dateInput = Carbon::createFromFormat('Y-m-d\TH:i', $value, 'Asia/Jakarta');
        dd($dateInput>$dateMin);
        return $dateInput > $dateMin;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The selected date must be 2 weeks minimum from now.';
    }
}
