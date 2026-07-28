<?php

namespace Modules\Blogs\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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

    public function all(Request $request): JsonResponse
    {
        $query = Blog::with('category');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content_short', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        $query->orderBy('created_at', 'desc');

        $perPage = min((int) $request->input('per_page', 15), 50);
        $blogs = $query->paginate($perPage);

        return $this->paginated($blogs, BlogResource::class);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|string|max:255',
            'category_id'   => 'required|integer|exists:blog_categories,id',
            'content_short' => 'sometimes|nullable|string',
            'content'       => 'sometimes|nullable|string',
            'time_read'     => 'sometimes|nullable|string|max:50',
            'is_featured'   => 'sometimes|boolean',
            'is_active'     => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['slug'] = Str::slug($data['title'], '-');

        $blog = Blog::create($data);

        return $this->success(new BlogResource($blog), 'Blog created successfully.', 201);
    }

    public function edit($id): JsonResponse
    {
        $blog = Blog::with('category')->findOrFail($id);
        return $this->success(new BlogResource($blog));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $blog = Blog::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title'         => 'sometimes|required|string|max:255',
            'category_id'   => 'sometimes|required|integer|exists:blog_categories,id',
            'content_short' => 'sometimes|nullable|string',
            'content'       => 'sometimes|nullable|string',
            'time_read'     => 'sometimes|nullable|string|max:50',
            'is_featured'   => 'sometimes|boolean',
            'is_active'     => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title'], '-') . '-' . $blog->id;
        }

        $blog->update($data);

        return $this->success(new BlogResource($blog->fresh()), 'Blog updated successfully.');
    }

    public function destroy($id): JsonResponse
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return $this->success(null, 'Blog deleted successfully.');
    }
}
