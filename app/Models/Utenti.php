<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utenti extends Model
{
    protected $table = 'Registrazioni';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function ordini()
    {
        return $this->hasMany(Ordini::class, 'Prodotti_Carrello', 'id_carrello', 'id_prodotto')
                    ->withPivot('quantita_totale', 'prezzo_totale');
    }
}
