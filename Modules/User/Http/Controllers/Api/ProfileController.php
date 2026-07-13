<?php

namespace Modules\User\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\User\Http\Resources\UserResource;

class ProfileController extends BaseApiController
{
    public function show(Request $request): JsonResponse
    {
        $user = $request->user()->load([
            'experiences',
            'qualifications',
            'skills',
            'preferredJobCategories',
            'languageProficiencies',
            'company'
        ]);

        return $this->success(new UserResource($user));
    }

    public function update(Request $request): JsonResponse
    {
        $user = $request->user();

        $request->validate([
            'name'            => 'sometimes|string|max:255',
            'father_name'     => 'sometimes|nullable|string|max:255',
            'mother_name'     => 'sometimes|nullable|string|max:255',
            'date_of_birth'   => 'sometimes|nullable|date',
            'gender'          => 'sometimes|nullable|string|max:50',
            'religion'        => 'sometimes|nullable|string|max:100',
            'marital_status'  => 'sometimes|nullable|string|max:50',
            'nationality'     => 'sometimes|nullable|string|max:100',
            'national_id'     => 'sometimes|nullable|string|max:100',
            'primary_mobile'  => 'sometimes|nullable|string|max:50',
            'secondary_mobile' => 'sometimes|nullable|string|max:50',
            'emergency_contact' => 'sometimes|nullable|string|max:50',
            'blood_group'     => 'sometimes|nullable|string|max:10',
            'present_address' => 'sometimes|nullable|string',
            'parmanent_address' => 'sometimes|nullable|string',
            'objective'       => 'sometimes|nullable|string',
            'present_salary'  => 'sometimes|nullable|numeric',
            'expected_salary' => 'sometimes|nullable|numeric',
            'job_level'       => 'sometimes|nullable|string|max:100',
            'job_nature'      => 'sometimes|nullable|string|max:100',
            'career_summary'  => 'sometimes|nullable|string',
            'special_qualification' => 'sometimes|nullable|string',
            'keywords'        => 'sometimes|nullable|array',
            'password'        => 'sometimes|nullable|string|min:6|confirmed',
        ]);

        $data = $request->except('password', 'password_confirmation');
        dd($data);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }


        $user->update($data);

        return $this->success(new UserResource($user->fresh()), 'Profile updated successfully');
    }

    public function uploadPhoto(Request $request): JsonResponse
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = $request->user();
        $image = $request->file('photo');
        $path_folder = public_path('storage/user_storage/' . $user->id);

        if (!file_exists($path_folder)) {
            mkdir($path_folder, 0755, true);
        }

        if ($user->photo) {
            $old_path = $path_folder . '/' . $user->photo;
            if (file_exists($old_path)) {
                unlink($old_path);
            }
        }

        $image_name = 'user_photo_' . rand() . '.' . $image->getClientOriginalExtension();
        $image->move($path_folder, $image_name);

        $user->update(['photo' => $image_name]);

        return $this->success(new UserResource($user->fresh()), 'Photo uploaded successfully');
    }
}
