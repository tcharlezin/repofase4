<?php

namespace CodeDelivery\Services;

use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\UserRepository;

class ClientService
{
    private $clientRepository;
    private $userRepository;

    public function __construct(ClientRepository $clientRepository, UserRepository $userRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    public function update(array $data, $id)
    {
        $this->clientRepository->update($data, $id);

        $userId = $this->clientRepository->find($id, ['user_id'])->user_id;
        $this->userRepository->update($data['user'], $userId);
    }

    public function create(array $data)
    {
        $data['password'] = bcrypt('123456');
        $user = $this->userRepository->create($data['user']);

        $data['user_id'] = $user->id;
        $this->clientRepository->create($data);
    }

    public function delete($id)
    {
        $user = $this->clientRepository->find($id)->user;

        $this->clientRepository->delete($id);
        $this->userRepository->delete($user->id);
    }

    public function get($id)
    {
        return $this->clientRepository->find($id);
    }

    public function lists()
    {
        return $this->clientRepository->paginate();
    }

}