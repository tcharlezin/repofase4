<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\CheckoutRequest;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
{
    private $userRepository;
    private $orderRepository;
    private $service;
    private $with = ['client', 'cupom', 'items'];

    public function __construct(UserRepository $userRepository,
        OrderRepository $orderRepository,
        OrderService $service)
    {
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->service = $service;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerid();
        $clientId = $this->userRepository->find($id)->client->id;
        $orders = $this->orderRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery(function($query) use ($clientId)
            {
                return $query->where('client_id', '=', $clientId);
            })->paginate();

        return $orders;
    }

    public function store(CheckoutRequest $request)
    {
        $data = $request->all();
        $id = Authorizer::getResourceOwnerid();
        $clientId = $this->userRepository->find($id)->client->id;
        $data['client_id'] = $clientId;
        $order = $this->service->create($data);

        return $this->orderRepository
                    ->with($this->with)
                    ->find($order->id);
    }

    public function show($id)
    {
        return $this->orderRepository
                    ->skipPresenter(false)
                    ->with($this->with)
                    ->find($id);
    }

}
