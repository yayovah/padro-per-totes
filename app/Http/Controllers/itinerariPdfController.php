<?php

namespace App\Http\Controllers;

use App\Models\Itinerari;
use App\Models\Pregunta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class itinerariPdfController extends Controller
{
    //Funció per generar i descarregar un PDF de l'itinerari associat a un usuari
    public function descarregaPDF($id){
        $itinerari = Itinerari::with(['relCiutat', 'passos.relPregunta', 'passos.relResposta']) //Carreguem les relacions necessàries per al PDF
            ->findOrFail($id);
        $pdf = Pdf::loadView('itineraripdf', compact('itinerari'));
        return $pdf->download('itinerario.pdf');
    }
}
