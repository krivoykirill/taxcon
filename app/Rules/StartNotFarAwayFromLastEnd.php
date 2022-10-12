<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Odometer;
use Carbon\Carbon;


class StartNotFarAwayFromLastEnd implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->dailyLimitKm = 200;

        $this->odometer = Odometer::where('user_id', $this->user->id)->whereNotNull('odometer_end')->orderBy('id', 'desc')->first();
        if (isset($this->odometer->odometer_end_date)) {
            $lastEndDate = Carbon::parse($this->odometer->odometer_end_date);
            $nowDate = Carbon::now();
            $daysDiff = $nowDate->diffInDays($lastEndDate);
            $this->allowedOffworkLimit = ($daysDiff + 1) * $this->dailyLimitKm;
        }

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

        if (!$this->odometer->odometer_end_date) {
            return true;
        }
        
        if (!$this->odometer) {
            return true;
        }

        if ($value < ($this->odometer->odometer_end + $this->allowedOffworkLimit)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Startam jābūt mazāk nekā pieļaujamam limitam no pēdējā finiša rādījuma ('.$this->allowedOffworkLimit.' km)';
    }
}
