<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckingLengthDescription implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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
        return strlen($this->data) <= 160;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Panjang teks tidak boleh lebih dari 160 karakter";
    }
}
