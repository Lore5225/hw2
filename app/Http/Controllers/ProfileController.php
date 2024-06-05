<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Utenti;
use App\Models\Ordini;

class ProfileController extends Controller
{
    public function checkAuth()
    {
        if (!Session::has('userID')) {
            return redirect('index');
        }

        $userID = Session::get('userID');
        $user = Utenti::find($userID);

        if (!$user) {
            return redirect('index');
        }
        $orders = Ordini::with('ordiniProdotti', 'ordiniProdotti.prodotto')->where('id_utente', $userID)->get();
        $totalOrders = $orders->count();
        return view('profile', compact('user', 'orders', 'totalOrders'));
    }
}
