<?php

namespace App\Exceptions;

use App\Enums\Code;
use App\Helpers\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * FunctionName：render
     * @param $request
     * @param Throwable $e
     * @return JsonResponse|Response|\Symfony\Component\HttpFoundation\Response
     * @throws BusinessException
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response|JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        // 请求类型错误异常抛出
        if ($e instanceof MethodNotAllowedHttpException) {
            $this->throwBusinessException(
                [Code::CLIENT_METHOD_HTTP_TYPE_ERROR, Code::getDescription(Code::CLIENT_METHOD_HTTP_TYPE_ERROR)]
            );
        }
        // 参数校验错误异常抛出
        if ($e instanceof ValidationException) {
            $this->throwBusinessException(
                [Code::CLIENT_PARAMETER_ERROR, Code::getDescription(Code::CLIENT_PARAMETER_ERROR)]
            );
        }
        // 路由不存在异常抛出
        if ($e instanceof NotFoundHttpException) {
            $this->throwBusinessException(
                [Code::CLIENT_NOT_FOUND_ERROR, Code::getDescription(Code::CLIENT_NOT_FOUND_ERROR)]
            );
        }
        // 自定义错误异常抛出
        if ($e instanceof BusinessException) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
        return parent::render($request, $e);
    }
}
