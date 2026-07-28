<?php

namespace Modules\Blogs\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Blogs\Entities\Category;

class CategoryController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = Category::withCount('blogs');

        if ($request->boolean('active_only')) {
            $query->active();
        }

        $query->orderBy('name');
        $categories = $query->get();

        return $this->success($categories->map(function ($cat) {
            return [
                'id'          => $cat->id,
                'name'        => $cat->name,
                'is_featured' => (bool) $cat->is_featured,
                'is_active'   => (bool) $cat->is_active,
                'blogs_count' => $cat->blogs_count,
                'created_at'  => $cat->created_at,
            ];
        }));
    }

    public function show($id): JsonResponse
    {
        $category = Category::withCount('blogs')->findOrFail($id);
        return $this->success([
            'id'          => $category->id,
            'name'        => $category->name,
            'is_featured' => (bool) $category->is_featured,
            'is_active'   => (bool) $category->is_active,
            'blogs_count' => $category->blogs_count,
            'created_at'  => $category->created_at,
        ]);
    }
}
