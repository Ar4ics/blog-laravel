<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class PostRequest extends Request {

public function authorize()
{
    return true;
}


public function rules()
{
    return [
        'email' => 'required|email|unique:users',
        'password' => 'required',
    ];
}
}