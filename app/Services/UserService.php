<?php

namespace App\Services;

use App\Enums\Code;
use App\Exceptions\BusinessException;

class UserService extends BaseService
{
    /**
     * FunctionName：getUserInfo
     * @return array
     * @throws BusinessException
     */
    public function getUserInfo(): array
    {
        $user = ['id' => 1, 'nickname' => '张三', 'age' => 18];
        if(empty($user)) {
            $this->throwBusinessException([Code::DELETED_ERROR, Code::getDescription(Code::DELETED_ERROR)]);
        }
        return $user;
    }
}
