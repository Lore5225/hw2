<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soluzioni;
use App\Models\schedaProdotti;

class InformationFromDatabaseController extends Controller
{
    public function viewSolution(Request $request)
    {
        $id = $request->query('Problem');

        if (!$id) {
            return redirect('index');
        }
        $solution = Soluzioni::find($id);
        if (!$solution) {
            return redirect('index');
        }
        $contenuto = json_decode($solution->contenuto, true);

        return view('ProblemAndSolution', [
            'titoli' => $contenuto['titoli'],
            'paragrafi' => $contenuto['paragrafi'],
            'immagini' => $contenuto['immagini']
        ]);
    }

    public function viewProductInformation(Request $request)
    {
        $id = $request->query('product');

        if (!$id) {
            return redirect('index');
        }
        $productInformation = schedaProdotti::find($id);
        if (!$productInformation) {
            return redirect('index');
        }
        $contenuto = json_decode($productInformation->contenuto, true);

        return view('DescriptionProducts', [
            'titoli' => $contenuto['titoli'],
            'paragrafi' => $contenuto['paragrafi'],
            'immagini' => $contenuto['immagini']
        ]);
    }
}
