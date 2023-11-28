<?php

namespace App\Http\Requests\ApiRequests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class BaseApiForm
{
    protected $request;
    protected $errors;
    abstract public function rules();

    public function __construct(Request $request)
    {
        $this->$request = $request;
        $rules = $this->rules();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $this->errors = $validator->errors()->toArray();
        }
    }
    public function getErrors()
    {
        return $this->errors;
    }
    public function getRequest()
    {
        return $this->request;
    }
}
