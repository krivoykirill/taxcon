<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Odometer;

class StartNotLessThanLastEnd implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        $odometer = Odometer::where('user_id', $this->user->id)->whereNotNull('odometer_end')->orderBy('id', 'desc')->first();
        if ($odometer && $odometer->odometer_end > $value) {
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
        return 'Startam vajadzētu būt lielāk nekā pēdējam finišam';
    }
}