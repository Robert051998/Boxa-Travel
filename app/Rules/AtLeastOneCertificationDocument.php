<?php

namespace App\Rules;
use App\Models\CertificationDocument;
use Illuminate\Contracts\Validation\InvokableRule;

class AtLeastOneCertificationDocument implements InvokableRule
{
    public function __construct($param)
{
    $this->property_id = $param;
}
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
        
        $result = CertificationDocument::select('id')->where('property_id', $this->property_id)->get()->toArray();
        if (count($result) < 1) {
            $fail("Please upload at least one certification document.");
        }
        //
    }
}
