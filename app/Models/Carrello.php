<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrello extends Model
{
    protected $table = 'Carrello';
    protected $primaryKey = 'id_carrello';
    protected $fillable = ['id_utente'];
    public $timestamps = false;

    public function prodotti()
    {
        return $this->belongsToMany(Prodotti::class, 'Prodotti_Carrello', 'id_carrello', 'id_prodotto')
            ->withPivot('quantita_totale', 'prezzo_totale');
    }
}
