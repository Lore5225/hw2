<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Carrello;
use App\Models\OrdiniProdotti;
use App\Models\ProdottiCarrello;
use App\Models\Prodotti;
use App\Models\Ordini;
use App\Models\Utenti;
use Illuminate\Support\Facades\Mail;
use Exception;

class CheckoutController extends BaseController
{
    public function checkAuth()
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

        return view('CheckoutPage', ['products' => $products]);
    }

    public function addOrder(Request $request)
    {
        $userID = Session::get('userID');
        if (!$userID) {
            return redirect('index');
        }

        $carrello = Carrello::where('id_utente', $userID)->first();
        if (!$carrello) {
            return redirect('index');
        }

        $ordine = new Ordini;
        $ordine->id_utente = $userID;
        $ordine->nome = $request->post('Nome');
        $ordine->cognome = $request->post('Cognome');
        $ordine->indirizzo = $request->post('address');
        $ordine->codice_postale = $request->post('postal_code');
        $ordine->numero_telefono = $request->post('phone_number');
        $ordine->note = $request->post('notes');
        $ordine->save();

        $idOrdine = $ordine->id_ordine;

        $cartItems = ProdottiCarrello::where('id_carrello', $carrello->id_carrello)->get();

        foreach ($cartItems as $item) {
            OrdiniProdotti::create([
                'id_ordine' => $idOrdine,
                'id_prodotto' => $item->id_prodotto,
                'quantità' => $item->quantita_totale,
                'prezzo_totale' => $item->prezzo_totale,
            ]);
        }

        ProdottiCarrello::where('id_carrello', $carrello->id_carrello)->delete();
        $carrello->delete();

        $orderDetails = [];
        $totalPrice = 0;
        $orderItems = OrdiniProdotti::where('id_ordine', $idOrdine)->get();

        foreach ($orderItems as $item) {
            $product = Prodotti::find($item->id_prodotto);
            if ($product) {
                $orderDetails[] = [
                    'nome_prodotto' => $product->nome,
                    'quantità' => $item->quantità,
                    'prezzo_totale' => $item->prezzo_totale
                ];
                $totalPrice += $item->prezzo_totale;
            }
        }

        $utente = Utenti::find($userID);
        $cliente_email = $utente->email;

        try {
            $message = "Gentile Cliente,\n\n";
            $message .= "Le confermiamo la ricezione dell'ordine numero '" . $idOrdine . "'. Di seguito i dettagli dell'ordine:\n\n";
            foreach ($orderDetails as $detail) {
                $message .= $detail['nome_prodotto'] . " " . $detail['quantità'] . " €" . $detail['prezzo_totale'] . "\n";
            }
            $message .= "\nTotale: €$totalPrice";
            $subject = "Conferma ordine";

            Mail::raw($message, function ($mail) use ($cliente_email, $subject) {
                $mail->to($cliente_email)
                    ->from('tecnovagroup@gmail.com')
                    ->subject($subject);
            });
        } catch (Exception $e) {
            return view('ConfirmPage', ['message' => 'Errore durante l\'invio della email di conferma: ' . $e->getMessage()]);
        }
        session(['email_sent' => true]);
        return redirect()->route('ConfirmPage')->with('message', 'Ordine confermato n. ' . $idOrdine . '!');
    }
}
