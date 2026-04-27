<?php

namespace App\Http\Controllers;

use App\Models\Itinerari;
use App\Models\Pregunta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class itinerariPdfController extends Controller
{
    public function descarregaPDF($id){
        $itinerari = Itinerari::with(['relCiutat', 'passos.relPregunta', 'passos.relResposta'])
                            ->findOrFail($id);
        $pdf = Pdf::loadView('itinerariPdf', compact('itinerari'));
        return $pdf->download('itinerario.pdf');
    }
}
