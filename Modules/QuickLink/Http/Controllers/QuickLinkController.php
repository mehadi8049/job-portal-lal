<?php

namespace Modules\QuickLink\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\QuickLink\Entities\QuickLink;

class QuickLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = QuickLink::latest()->paginate(20);
        return view('quicklink::quicklink.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('quicklink::quicklink.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link_url' => 'required|url|max:255',
            'serial' => 'required|numeric',
        ]);

        QuickLink::create([
            'title' => $request->title,
            'link_url' => $request->link_url,
            'serial' => $request->serial,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('quick-link.index')->with('success', __('Quick Link created successfully.'));
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(QuickLink $quickLink)
    {
        return view('quicklink::quicklink.edit', compact('quickLink'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, QuickLink $quickLink)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link_url' => 'required|url|max:255',
            'serial' => 'required|numeric',
        ]);

        $quickLink->update([
            'title' => $request->title,
            'link_url' => $request->link_url,
            'serial' => $request->serial,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('quick-link.index')->with('success', __('Quick Link updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(QuickLink $quickLink)
    {
        $quickLink->delete();
        return redirect()->route('quick-link.index')->with('success', __('Quick Link deleted successfully.'));
    }
}
