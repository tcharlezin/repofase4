<?php

namespace CodeDelivery\Http\Middleware;

use Closure;
use CodeDelivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Symfony\Component\VarDumper\VarDumper;

class OAuthCheckRole
{
    private $userRepository;

    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }

    public function handle($request, Closure $next, $role)
    {
        $id = Authorizer::getResourceOwnerid();
        $user = $this->userRepository->find($id);

        if($user->role != $role)
        {
            abort(403, 'Access forbidden.');
        }

        return $next($request);
    }
}
