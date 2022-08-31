<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Odometer;

class StartEndLimits implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($odometer_id)
    {
        $this->odometer_id = $odometer_id;
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
        $odometer = Odometer::where('id', $this->odometer_id)->first();
        if ($odometer && ($value - $odometer->odometer_start > 500)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Odometra starpība nevar būt vairāk nekā 500km';
    }
}