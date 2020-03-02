<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->paginate();
        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id, UserRepository $userRepository)
    {
        $deliveryMan = $userRepository->getDeliverymen();

        $list_status = [
            '0' => 'Pendente',
            '1' => 'A caminho',
            '2' => 'Entregue',
            '3' => 'Cancelado'
        ];

        $order = $this->orderRepository->find($id);
        return view('admin.orders.edit', compact('order', 'list_status', 'deliveryMan'));
    }

    public function update(Request $request, $id)
    {
        $all = $request->all();
        $this->orderRepository->update($all, $id);

        return redirect()->route('admin.orders.index');
    }

}