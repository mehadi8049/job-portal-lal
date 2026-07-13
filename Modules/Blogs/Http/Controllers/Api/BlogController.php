<?php

namespace Modules\Blogs\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Blogs\Entities\Blog;
use Modules\Blogs\Http\Resources\BlogResource;

class BlogController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = Blog::with('category')->active();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content_short', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->boolean('featured')) {
            $query->featured();
        }

        $query->orderBy('created_at', 'desc');

        $perPage = min((int) $request->input('per_page', 15), 50);
        $blogs = $query->paginate($perPage);

        return $this->paginated($blogs, BlogResource::class);
    }

    public function show($id): JsonResponse
    {
        $blog = Blog::with('category')->active()->findOrFail($id);
        return $this->success(new BlogResource($blog));
    }
}
