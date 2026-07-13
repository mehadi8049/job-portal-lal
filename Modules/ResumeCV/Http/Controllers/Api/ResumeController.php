<?php

namespace Modules\ResumeCV\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\ResumeCV\Entities\Resumecv;

class ResumeController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $resumes = $request->user()->resumecvs()->orderBy('created_at', 'desc')->get();

        return $this->success($resumes->map(function ($resume) {
            return [
                'id'         => $resume->id,
                'name'       => $resume->name,
                'slug'       => $resume->slug,
                'code'       => $resume->code,
                'is_publish' => (bool) $resume->is_publish,
                'view_count' => $resume->view_count,
                'created_at' => $resume->created_at,
                'updated_at' => $resume->updated_at,
            ];
        }));
    }
}
