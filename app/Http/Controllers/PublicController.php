<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function checkPdf(Request $request){
        $pdf = PDF::loadview('admin.components.award-notice-template')->setPaper('legal', 'portrait');

        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $directoryPath = storage_path('app/public/');
        $pdfFileName = 'test.pdf';
        $pdf->save($directoryPath . $pdfFileName);

        return view('pdf-file', compact('pdfFileName'));
    }
}
