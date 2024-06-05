<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdottiCarrello extends Model
{
    protected $table = 'Prodotti_Carrello';
    protected $primaryKey = 'id';
    protected $fillable = ['id_carrello', 'id_prodotto', 'quantita_totale', 'prezzo_totale'];
    public $timestamps = false;
    
    public function prodotto()
    {
        return $this->belongsTo(Prodotti::class, 'id_prodotto', 'id');
    }

    public function carrello()
    {
        return $this->belongsTo(Carrello::class, 'id_carrello');
    }
}
