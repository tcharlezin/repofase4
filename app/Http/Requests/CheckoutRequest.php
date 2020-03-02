<?php

namespace CodeDelivery\Http\Requests;

use Illuminate\Http\Request as HttpRequest;

class CheckoutRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules(HttpRequest $request)
    {
        $rules = ['cupom_code' => 'exists:cupoms,code,used,0'];

        $this->buildRulesItens(0, $rules);

        $items = $request->get('items', []);
        $items = !is_array($items) ? [] : $items;

        foreach($items as $key => $val)
        {
            $this->buildRulesItens($key, $rules);
        }

        return $rules;
    }


    public function buildRulesItens($key, array &$rules)
    {
        $rules["items.$key.product_id"] = 'required';
        $rules["items.$key.qtd"] = 'required';

    }

}
