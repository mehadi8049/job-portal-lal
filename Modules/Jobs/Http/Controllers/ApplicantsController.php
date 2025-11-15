<?php

namespace Modules\Jobs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Jobs\Entities\JobApplicant;

class ApplicantsController extends Controller
{
    public function index(Request $request)
    {
      $data = JobApplicant::with(['job.company'])->orderBy('created_at', 'DESC');

      if ($request->filled('search'))
      {
          $data->where('fullname', 'like', '%' . $request->search . '%');
      }
      $data = $data->paginate(10);

      return view('jobs::applicants.index', compact('data'));
    }

    public function destroy(Request $request, $id)
    {
        $item = JobApplicant::findOrFail($id);

        $item->delete();

        return redirect()->back()->with('success', __('Deleted successfully'));
    }
}
