<?php

namespace CodeDelivery\Services;


use CodeDelivery\Models\Order;
use CodeDelivery\Repositories\CupomRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use DB;
use Symfony\Component\VarDumper\VarDumper;

class OrderService
{
    private $orderRepository;
    private $cupomRepository;
    private $productRepository;

    public function __construct(OrderRepository $orderRepository, CupomRepository $cupomRepository, ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->cupomRepository = $cupomRepository;
        $this->productRepository = $productRepository;
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try
        {
            $data['status'] = 0;
            if (isset($data['cupom_code'])) {
                $cupom = $this->cupomRepository->findByField('code', $data['cupom_code'])->first();
                $data['cupom_id'] = $cupom->id;
                $cupom->used = true;
                $cupom->save();
                unset($data['cupom_code']);
            }

            $items = $data['items'];
            unset($data['items']);

            $total = 0;
            $data['total'] = $total;

            $order = $this->orderRepository->create($data);

            foreach ($items as $item) {
                $item['price'] = $this->productRepository->find($item['product_id'])->price;
                $order->items()->create($item);
                $total += $item['price'] * $item['qtd'];
            }

            $order->total = $total;

            if (isset($cupom)) {
                $order->total = $total - $cupom->value;
            }

            $order->save();

            DB::commit();

            return $order;
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            throw $ex;
        }
    }

    public function updateStatus($id, $idDeliveryman, $status)
    {
        $order = $this->orderRepository->getByIdAndDeliveryman($id, $idDeliveryman);
        if($order instanceof Order)
        {
            $order->status = $status;
            $order->save();
            return $order;
        }

        return false;
    }
}