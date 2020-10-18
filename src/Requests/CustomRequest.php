<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Rafadepaula\Tools\Facades\Functions;

class CustomRequest extends FormRequest
{
	protected function prepareForValidation()
	{
		$fields = $this->all();
		foreach($fields as $name => $value){
			if(strpos($value, 'R$') !== false){
				$fields[$name] = Functions::moneyToDecimal($value);
			}
		}
		$this->merge($fields);
	}
}
