<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class BaseApiController extends Controller
{
    protected function success($data = null, string $message = '', int $code = 200, array $extra = []): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ];

        if (!empty($extra)) {
            $response = array_merge($response, $extra);
        }

        return response()->json($response, $code);
    }

    protected function error(string $message = '', int $code = 400, $errors = null): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!is_null($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

    protected function paginated($paginator, $resourceClass, string $message = ''): JsonResponse
    {
        return $this->success(
            $resourceClass::collection($paginator->items()),
            $message,
            200,
            [
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page'    => $paginator->lastPage(),
                    'per_page'     => $paginator->perPage(),
                    'total'        => $paginator->total(),
                ]
            ]
        );
    }
}
