<?php

namespace App\Rules;

use App\Lot;
use Illuminate\Contracts\Validation\Rule;

class OneOpenLot implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if (preg_match("/update/", request()->getRequestUri())) return true; // если запрос из update, то true
        $lots = Lot::query()
            ->whereProductIdAndClosed($value, 0)
            ->get()
            ->all();
        if (empty($lots)) return true;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The product has an active lot. Close the lot or choose another product.';
    }
}
