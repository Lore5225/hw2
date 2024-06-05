<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\Prodotti;

class ShoppingPageController extends BaseController
{
    public function checkAuth()
    {
        if (!Session::has('userID')) {
            return redirect('loginpage');
        }
        
        $products = Prodotti::all();
        return view('ShoppingPage', ['products' => $products]);
    }

    public function getProduct($id)
{
    $product = Prodotti::find($id);
    
    if (!$product) {
        return response()->json(['error' => 'Prodotto non trovato']);
    }

    return response()->json($product);
}


}
