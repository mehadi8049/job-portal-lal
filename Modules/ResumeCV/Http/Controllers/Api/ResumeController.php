<?php

namespace Modules\ResumeCV\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:190',
            'content'   => 'sometimes|nullable|string',
            'style'     => 'sometimes|nullable|string',
            'is_publish' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['user_id'] = $request->user()->id;
        $data['is_publish'] = $request->boolean('is_publish', true);

        $resume = Resumecv::create($data);

        return $this->success([
            'id'         => $resume->id,
            'name'       => $resume->name,
            'code'       => $resume->code,
            'slug'       => $resume->slug,
            'content'    => $resume->content,
            'style'      => $resume->style,
            'is_publish' => (bool) $resume->is_publish,
            'created_at' => $resume->created_at,
            'updated_at' => $resume->updated_at,
        ], 'Resume created successfully.', 201);
    }

    public function show(Request $request, $code): JsonResponse
    {
        $resume = Resumecv::where('code', $code)->where('user_id', $request->user()->id)->firstOrFail();

        return $this->success([
            'id'         => $resume->id,
            'name'       => $resume->name,
            'code'       => $resume->code,
            'slug'       => $resume->slug,
            'content'    => $resume->content,
            'style'      => $resume->style,
            'is_publish' => (bool) $resume->is_publish,
            'view_count' => $resume->view_count,
            'created_at' => $resume->created_at,
            'updated_at' => $resume->updated_at,
        ]);
    }

    public function update(Request $request, $code): JsonResponse
    {
        $resume = Resumecv::where('code', $code)->where('user_id', $request->user()->id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name'       => 'sometimes|required|string|max:190',
            'content'    => 'sometimes|nullable|string',
            'style'      => 'sometimes|nullable|string',
            'is_publish' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $resume->update($data);

        return $this->success([
            'id'         => $resume->id,
            'name'       => $resume->name,
            'code'       => $resume->code,
            'slug'       => $resume->slug,
            'content'    => $resume->content,
            'style'      => $resume->style,
            'is_publish' => (bool) $resume->is_publish,
            'view_count' => $resume->view_count,
            'created_at' => $resume->created_at,
            'updated_at' => $resume->updated_at,
        ], 'Resume updated successfully.');
    }

    public function destroy(Request $request, $code): JsonResponse
    {
        $resume = Resumecv::where('code', $code)->where('user_id', $request->user()->id)->firstOrFail();
        $resume->delete();

        return $this->success(null, 'Resume deleted successfully.');
    }

    public function clone(Request $request, $code): JsonResponse
    {
        $resume = Resumecv::where('code', $code)->where('user_id', $request->user()->id)->firstOrFail();

        $clone = $resume->replicate();
        $clone->name = $resume->name . ' (Copy)';
        $clone->save();

        return $this->success([
            'id'         => $clone->id,
            'name'       => $clone->name,
            'code'       => $clone->code,
            'slug'       => $clone->slug,
            'content'    => $clone->content,
            'style'      => $clone->style,
            'is_publish' => (bool) $clone->is_publish,
            'created_at' => $clone->created_at,
            'updated_at' => $clone->updated_at,
        ], 'Resume cloned successfully.', 201);
    }

    public function download(Request $request, $code)
    {
        $resume = Resumecv::where('code', $code)->where('user_id', $request->user()->id)->firstOrFail();

        $content = replaceVarContentStyle($resume->content);
        $style = replaceVarContentStyle($resume->style);

        $html = '<html><head><style>' . $style . '</style></head><body>' . $content . '</body></html>';

        $pdf = Pdf::loadHTML($html)
            ->setPaper('A4', 'portrait')
            ->setOption('margin-top', '0')
            ->setOption('margin-bottom', '0')
            ->setOption('margin-left', '0')
            ->setOption('margin-right', '0');

        return $pdf->download($resume->slug . '.pdf');
    }
}
