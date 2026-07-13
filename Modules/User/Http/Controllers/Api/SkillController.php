<?php

namespace Modules\User\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\User\Entities\Skill;
use Modules\User\Http\Resources\SkillResource;

class SkillController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $skills = $request->user()->skills()->orderBy('created_at', 'desc')->get();
        return $this->success(SkillResource::collection($skills));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'skill_name'        => 'required|string|max:255',
            'skill_learned_from' => 'sometimes|nullable|array',
        ]);

        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        if (!isset($data['skill_learned_from'])) {
            $data['skill_learned_from'] = [];
        }

        $skill = Skill::create($data);

        return $this->success(new SkillResource($skill), 'Skill added successfully', 201);
    }

    public function show(Request $request, $id): JsonResponse
    {
        $skill = Skill::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        return $this->success(new SkillResource($skill));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $skill = Skill::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();

        $request->validate([
            'skill_name'        => 'sometimes|required|string|max:255',
            'skill_learned_from' => 'sometimes|nullable|array',
        ]);

        $data = $request->all();
        if (!$request->has('skill_learned_from')) {
            $data['skill_learned_from'] = [];
        }

        $skill->update($data);

        return $this->success(new SkillResource($skill->fresh()), 'Skill updated successfully');
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        $skill = Skill::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $skill->delete();

        return $this->success(null, 'Skill deleted successfully');
    }
}
