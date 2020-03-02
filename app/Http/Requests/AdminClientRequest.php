<?php

namespace CodeDelivery\Http\Requests;

use CodeDelivery\Repositories\ClientRepository;
use Illuminate\Validation\Rule;

class AdminClientRequest extends Request
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
    public function rules(ClientRepository $repository)
    {
        $isUpdate = ! is_null($this->id) ? ','.$this->id : '';

        $rules = [];
        $rules['user.name'] = 'required';
        // $rules['user.email'] = 'required|unique:users,email' . $isUpdate;
        $rules['phone'] = 'required';
        $rules['address'] = 'required';
        $rules['city'] = 'required';
        $rules['state'] = 'required';

        return $rules;
    }
}
