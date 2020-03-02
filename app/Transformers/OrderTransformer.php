<?php

namespace CodeDelivery\Transformers;

use CodeDelivery\Models\OrderItem;
use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Order;

class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['cupom', 'items'];

    public function transform(Order $model)
    {
        return [
            'id'         => (int) $model->id,
            'total' => (float) $model->total,

            // 'cupom' => $model->cupom,
            // 'items' => $model->items,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeCupom(Order $model)
    {
        if(!$model->cupom)
        {
            return null;
        }

        return $this->item($model->cupom, new CupomTransformer());
    }

    public function includeItems(Order $model)
    {
        return $this->collection($model->items, new OrderItemTransformer());
    }

}
