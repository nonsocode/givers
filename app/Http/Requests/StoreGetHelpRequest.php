<?php

namespace App\Http\Requests;

use App\Config as Conf;
use Illuminate\Foundation\Http\FormRequest;

class StoreGetHelpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'earnings' => 'bail|required',
            // 'earnings.*' => 'exists:earnings,id',
            'g-recaptcha-response' => 'required|recaptcha',
            'bank_account' => 'exists:bank_accounts,id|required|bail',
        ];
    }

    public function withValidator($validator)
    {
        $total = collect(request()->earning)->sum();
        $validator->after(function($validator)use($total){
            if ($total > Conf::val('gh_max')) {
               $validator->errors()->add('too-much', 'The total selected Earnings exceeds the maximum allowed. Please select an amount less than '.number_format(Conf::val('gh_max')));
            }
        });
    }
}
