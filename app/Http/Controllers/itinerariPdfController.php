<?php

namespace App\Http\Controllers;

use App\Models\Itinerari;
use Illuminate\Http\Request;

class itinerariPdfController extends Controller
{
    public function descarregarPDF($id){
        $itinerari = Itinerari::find($id)->with();
        //return Pdf::loadView('itinerari', compact($itinerari));
    }
}
