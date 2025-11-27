<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;

class GenerateCvPdfController extends Controller
{
    public function generateCv(Request $request)
    {
        $user = $request->user()->load('experiences', 'qualifications', 'skills', 'preferredJobCategories', 'languageProficiencies');
        if ($user) {
            return redirect()->back()->with('error', __("Please complete your profile fisrt with a photo."));
        }

        $text = "
           - name: " . $user->name . ";
           - job lavel: " . $user->job_level . ";
           - job nature: " . $user->job_nature . ";
           - special qualification: " . $user->special_qualification . ";
           - keywords: " . ($user->keywords ? implode(',', $user->keywords) : '') . ";
           - skills: " . ($user->skills ? json_encode($user->skills) : '') . ";
           - experiences: " . ($user->experiences ? json_encode($user->experiences) : '') . ";
           - qualifications: " . ($user->qualifications ? json_encode($user->qualifications) : '') . ";
           - generate a simple 7 lines career objective with add skill autometicaly and no heading just objective
           - do not use any variable
           - use above job lavel, job nature and skills
        ";

        if (!$user->objective) {
            $response = Http::post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key=" . env('GEMINI_API_KEY'),
                [
                    'contents' => [
                        ['parts' => [['text' => $text]]]
                    ]
                ]
            );

            $result = $response->json();
            $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;
            if ($text) {
                $user->objective = $text;
                $user->save();
            }
        }


        $html = view('user::pdf.generate', compact('user'))->render();

        $pdf = Pdf::loadHTML($html)
            ->setPaper('A4', 'portrait')
            ->setOption('margin-top', '20mm')
            ->setOption('margin-bottom', '20mm')
            ->setOption('margin-left', '15mm')
            ->setOption('margin-right', '15mm');

        // Download PDF
        return $pdf->download('cv.pdf');
    }
}
