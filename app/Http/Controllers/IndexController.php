<?php

namespace App\Http\Controllers;

use App\Exceptions\BusinessException;
use App\Http\Requests\BlogRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class IndexController extends BaseController
{
    /**
     * FunctionName：index
     * @return JsonResponse
     * @throws BusinessException
     */
    public function index(): JsonResponse
    {
        $id = $this->verifyId('id', null);
        return $this->success($id);
    }

    /**
     * FunctionName：info
     * @param UserService $userService
     * @return JsonResponse
     * @throws BusinessException
     */
    public function info(UserService $userService): JsonResponse
    {
        $user = $userService->getUserInfo();
        return $this->success($user);
    }

    /**
     * FunctionName：store
     * @param BlogRequest $request
     * @return JsonResponse
     */
    public function store(BlogRequest $request): JsonResponse
    {
        return $this->success();
    }
}
