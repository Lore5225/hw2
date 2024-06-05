<?php

namespace App\Http\Controllers;

use App\Models\Carrello;
use App\Models\Prodotti;
use App\Models\ProdottiCarrello;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;

class CartController extends Controller
{
    public function viewCart()
    {
        $userID = Session::get('userID');
        if (!$userID) {
            return redirect('index');
        }
        $carrello = Carrello::where('id_utente', $userID)->first();
        if (!$carrello) {
            return view('ShoppingCart', ['products' => []]);
        }
        $prodottiCarrello = ProdottiCarrello::where('id_carrello', $carrello->id_carrello)->get();
        $products = [];
    
        foreach ($prodottiCarrello as $item) {
            $product = Prodotti::find($item->id_prodotto);
            if ($product) {
                $product->quantita_totale = $item->quantita_totale;
                $product->prezzo_totale = $item->prezzo_totale;
                $products[] = $product;
            }
        }
    
        return view('ShoppingCart', ['products' => $products]);
    }
    

    public function addToCart()
    {
        if (!Session::has('userID')) {
            return redirect('index');
        }
        $id_prodotto = Request::post('id');
        $id_utente = Session::get('userID');
        $carrello = Carrello::firstOrCreate(['id_utente' => $id_utente]);
        $prodotto_carrello = $carrello->prodotti()->where('prodotti.id', $id_prodotto)->first();

        if ($prodotto_carrello) {
            $quantita = $prodotto_carrello->pivot->quantita_totale + 1;
            $prodotto_carrello->pivot->quantita_totale = $quantita;
            $prodotto_carrello->pivot->prezzo_totale = $quantita * $prodotto_carrello->prezzo;
            $prodotto_carrello->pivot->save();
        } else {
            $prezzo = Prodotti::find($id_prodotto)->prezzo;
            $nuovoProdottoCarrello = new ProdottiCarrello;
            $nuovoProdottoCarrello->id_carrello = $carrello->id_carrello;
            $nuovoProdottoCarrello->id_prodotto = $id_prodotto;
            $nuovoProdottoCarrello->quantita_totale = 1;
            $nuovoProdottoCarrello->prezzo_totale = $prezzo;
            $nuovoProdottoCarrello->save();
        }

        return response()->json(['success' => true]);
    }

    public function removeFromCart()
    {
        if (!Session::has('userID')) {
            return redirect('index');
        }

        $id_prodotto = Request::post('id');
        $id_utente = Session::get('userID');
        $carrello = Carrello::where('id_utente', $id_utente)->first();

        if ($carrello) {
            $prodotto_carrello = $carrello->prodotti()->where('prodotti.id', $id_prodotto)->first();
            
            if ($prodotto_carrello) {
                if ($prodotto_carrello->pivot->quantita_totale > 1) {
                    $prodotto_carrello->pivot->quantita_totale -= 1;
                    $prodotto_carrello->pivot->prezzo_totale = $prodotto_carrello->pivot->quantita_totale * $prodotto_carrello->prezzo;
                    $prodotto_carrello->pivot->save();
                } else {
                    $prodotto_carrello->pivot->delete();
                }

                return response()->json(['success' => true]);
            }
        }

        return response()->json(['error' => 'Prodotto non trovato nel carrello']);
    }
    public function viewUpdatedCart()
    {
        $userID = Session::get('userID');
        if (!$userID) {
            return redirect('index');
        }
        $carrello = Carrello::where('id_utente', $userID)->first();
        if (!$carrello) {
            return response()->json([]);
        }
        $prodottiCarrello = ProdottiCarrello::where('id_carrello', $carrello->id_carrello)->get();
        $products = [];
        foreach ($prodottiCarrello as $item) {
            $product = Prodotti::find($item->id_prodotto);
            if ($product) {
                $product->quantita_totale = $item->quantita_totale;
                $product->prezzo_totale = $item->prezzo_totale;
                $products[] = $product;
            }
        }
        return response()->json($products);
    }
    
}
