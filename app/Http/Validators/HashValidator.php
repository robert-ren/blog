<?php
/**
 * Created by PhpStorm.
 * User: robertren
 * Date: 13/7/18
 * Time: 9:10 AM
 */

namespace App\Http\Validators;

use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Hash;

class HashValidator extends Validator
{
    public function validateHash($attribute, $value, $parameters)
    {
        return Hash::check($value, $parameters[0]);
    }
}