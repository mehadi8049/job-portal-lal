<?php

namespace Modules\User\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\User\Entities\LanguageProficiency;
use Modules\User\Http\Resources\LanguageProficiencyResource;

class LanguageProficiencyController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $languages = $request->user()->languageProficiencies()->orderBy('created_at', 'desc')->get();
        return $this->success(LanguageProficiencyResource::collection($languages));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'language_name'  => 'required|string|max:255',
            'reading_level'  => 'sometimes|nullable|string|max:50',
            'writing_level'  => 'sometimes|nullable|string|max:50',
            'speaking_level' => 'sometimes|nullable|string|max:50',
        ]);

        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $language = LanguageProficiency::create($data);

        return $this->success(new LanguageProficiencyResource($language), 'Language proficiency added successfully', 201);
    }

    public function show(Request $request, $id): JsonResponse
    {
        $language = LanguageProficiency::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        return $this->success(new LanguageProficiencyResource($language));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $language = LanguageProficiency::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();

        $request->validate([
            'language_name'  => 'sometimes|required|string|max:255',
            'reading_level'  => 'sometimes|nullable|string|max:50',
            'writing_level'  => 'sometimes|nullable|string|max:50',
            'speaking_level' => 'sometimes|nullable|string|max:50',
        ]);

        $language->update($request->all());

        return $this->success(new LanguageProficiencyResource($language->fresh()), 'Language proficiency updated successfully');
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        $language = LanguageProficiency::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $language->delete();

        return $this->success(null, 'Language proficiency deleted successfully');
    }
}
