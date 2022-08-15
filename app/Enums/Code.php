<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Code extends Enum
{
    const AUTHORIZATION = 403;
    const SUCCESS = 200001;
    const ERROR = 200002;
    const DELETED_ERROR = 400202;
    const CLIENT_PARAMETER_ERROR = 400200;
    const CLIENT_NOT_FOUND_ERROR = 404001;
    const CLIENT_METHOD_HTTP_TYPE_ERROR = 405001;
    const SYSTEM_ERROR = 500001;

    public static function getDescription($value): string
    {
        $descriptions = [
            self::SUCCESS => '操作成功',
            self::ERROR => '操作失败',
            self::DELETED_ERROR => '数据不存在',
            self::CLIENT_PARAMETER_ERROR => '参数错误',
            self::CLIENT_NOT_FOUND_ERROR => '没有找到该页面',
            self::CLIENT_METHOD_HTTP_TYPE_ERROR => 'HTTP请求类型错误',
            self::SYSTEM_ERROR => '服务器错误',
            self::AUTHORIZATION => '没有权限访问'
        ];

        return $descriptions[$value] ?? '未知的状态码';
    }
}
