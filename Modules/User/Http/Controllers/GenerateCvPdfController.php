<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GenerateCvPdfController extends Controller
{
    public function generateCv(Request $request)
    {
        $data = [
            'name'       => 'Mehadi Hasan',
            'email'      => 'mehadi@example.com',
            'phone'      => '017XXXXXXXX',
            'skills'     => ['Laravel', 'Vue.js', 'API Development', 'MySQL'],
            'experience' => [
                [
                    'company' => 'ABC Ltd.',
                    'role'    => 'Web Developer',
                    'years'   => '2021 - Present'
                ],
                [
                    'company' => 'XYZ IT',
                    'role'    => 'Junior Developer',
                    'years'   => '2019 - 2021'
                ]
            ]
        ];

        // Render Blade as HTML
        $html = view('user::pdf.generate', compact('data'))->render();

        // Generate PDF from HTML string
        $pdf = Pdf::loadHTML($html);

        // Optional settings
        $pdf->setPaper('A4', 'portrait');

        // Download PDF
        return $pdf->download('cv.pdf');
    }
}
