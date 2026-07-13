<?php

namespace Modules\Contacts\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Contacts\Entities\Contact;

class ContactController extends BaseApiController
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'sometimes|nullable|string|max:50',
            'subject'  => 'sometimes|nullable|string|max:255',
            'content'  => 'required|string',
        ]);

        $contact = Contact::create($request->all());

        return $this->success([
            'id' => $contact->id,
        ], 'Message sent successfully', 201);
    }
}
