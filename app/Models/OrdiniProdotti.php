<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdiniProdotti extends Model
{

    protected $table = 'ordini_prodotti';

    protected $fillable = [
        'id_ordine',
        'id_prodotto',
        'quantità',
        'prezzo_totale',
    ];
    public $timestamps = false;

    public function ordini()
    {
        return $this->belongsTo(Ordini::class, 'id_ordine');
    }

    public function prodotto()
    {
        return $this->belongsTo('App\Models\Prodotti', 'id_prodotto', 'id');
    }
}
