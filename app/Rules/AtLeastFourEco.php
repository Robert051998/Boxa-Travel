<?php

namespace App\Rules;
use App\Models\Amenities;
use Illuminate\Contracts\Validation\InvokableRule;

class AtLeastFourEco implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        // dd($value);
        $result = Amenities::select('id')->where('status', 'Active')->where('type_id', 3)->wherein('id', $value)->get()->toArray();        
        if (count($result) < 4) {
            $fail("Please select at least 4 eco friendly amnities.");
        }
    }
}
