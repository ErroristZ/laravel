<?php

namespace App\Helpers;

use App\Enums\Code;
use App\Exceptions\BusinessException;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait ApiResponse
{
    /**
     * 成功
     * @param array|null $data
     * @return JsonResponse
     */
    public function success(?array $data = []): JsonResponse
    {
        return $this->jsonResponse(Code::SUCCESS, Code::getDescription(Code::SUCCESS), $data);
    }

    /**
     * 失败
     * @param array|null $data
     * @return JsonResponse
     */
    public function fail(?array $data = []): JsonResponse
    {
        return $this->jsonResponse(Code::ERROR, Code::getDescription(Code::ERROR), $data);
    }

    /**
     * json响应
     * @param $code
     * @param $message
     * @param $data
     * @return JsonResponse
     */
    private function jsonResponse($code, $message, $data): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data ?? null
        ]);
    }

    /**
     * 成功分页返回
     * @param $page
     * @return JsonResponse
     */
    protected function successPaginate($page): JsonResponse
    {
        return $this->success($this->paginate($page));
    }

    private function paginate($page)
    {
        if ($page instanceof LengthAwarePaginator) {
            return [
                'total' => $page->total(),
                'page' => $page->currentPage(),
                'limit' => $page->perPage(),
                'pages' => $page->lastPage(),
                'list' => $page->items()
            ];
        }
        if ($page instanceof Collection) {
            $page = $page->toArray();
        }
        if (!is_array($page)) {
            return $page;
        }
        $total = count($page);
        return [
            'total' => $total,
            'page' => 1,
            'limit' => $total,
            'pages' => 1,
            'list' => $page
        ];
    }

    /**
     * 业务异常返回
     * @param array $codeResponse
     * @param string $info
     * @throws BusinessException
     */
    public function throwBusinessException(array $codeResponse = [], string $info = '')
    {
        $codeResponse = empty($codeResponse) ? [Code::ERROR, Code::getDescription(Code::ERROR)] : $codeResponse;
        throw new BusinessException($codeResponse, $info);
    }
}
