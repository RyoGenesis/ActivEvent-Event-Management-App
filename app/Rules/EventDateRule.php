<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class EventDateRule implements Rule
{

    protected $event, $attr;

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
        $this->attr = $attribute;
        
        if($this->event) {
            //also check that the changed date cannot be too close either
            $dateMin = Carbon::today()->addDays(4); //ex for now, minimum 4 days
            $dateInput = Carbon::createFromFormat('Y-m-d\TH:i', $value, 'Asia/Jakarta');

            //check if date value changed or not, if not then allow it as true
            if($attribute == 'date' && $dateInput == $this->event->date) {
                return true;
            } else if($attribute == 'registration_end' && $dateInput == $this->event->registration_end) {
                return true;
            }

            return $dateInput > $dateMin;
        }
        
        //initially, must be minimum 2 weeks
        $dateMin = Carbon::today()->addWeek(2);
        $dateInput = Carbon::createFromFormat('Y-m-d\TH:i', $value, 'Asia/Jakarta');
        return $dateInput > $dateMin;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $attrName = $this->attr == 'date' ? 'event date' : 'registration end date';
        if($this->event) {
            return 'The selected '.$attrName.' must be 4 days minimum from now.';
        }
        return 'The selected '.$attrName.' must be 2 weeks minimum from now.';
    }
}
