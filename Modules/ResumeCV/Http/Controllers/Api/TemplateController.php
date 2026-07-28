<?php

namespace Modules\ResumeCV\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\ResumeCV\Entities\Resumecvcategory;
use Modules\ResumeCV\Entities\Resumecvtemplate;

class TemplateController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $categories = Resumecvcategory::with(['templates' => function ($q) {
            $q->active()->orderBy('name');
        }])->orderBy('name')->get();

        return $this->success($categories->map(function ($cat) {
            return [
                'id'        => $cat->id,
                'name'      => $cat->name,
                'templates' => $cat->templates->map(function ($tmpl) {
                    return [
                        'id'          => $tmpl->id,
                        'name'        => $tmpl->name,
                        'thumb'       => $tmpl->thumb ? url('storage/thumb_templates/' . $tmpl->thumb) : null,
                        'is_premium'  => (bool) $tmpl->is_premium,
                        'is_auto'     => (bool) $tmpl->is_auto,
                    ];
                }),
            ];
        }));
    }

    public function show($id): JsonResponse
    {
        $template = Resumecvtemplate::with('category')->active()->findOrFail($id);

        return $this->success([
            'id'          => $template->id,
            'category_id' => $template->category_id,
            'name'        => $template->name,
            'thumb'       => $template->thumb ? url('storage/thumb_templates/' . $template->thumb) : null,
            'content'     => $template->content,
            'style'       => $template->style,
            'is_auto'     => (bool) $template->is_auto,
            'is_premium'  => (bool) $template->is_premium,
            'category'    => $template->category ? [
                'id'   => $template->category->id,
                'name' => $template->category->name,
            ] : null,
        ]);
    }
}
