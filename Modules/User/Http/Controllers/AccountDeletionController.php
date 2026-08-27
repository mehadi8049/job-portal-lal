<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\AccountDeletionRequest;

class AccountDeletionController extends Controller
{
    public function showForm()
    {
        $skin = config('app.SITE_LANDING');
        return view('themes::' . $skin . '.auth.account-deletion');
    }

    public function submitRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        AccountDeletionRequest::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', __('Your account deletion request has been submitted. We will review it shortly.'));
    }
}
