<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Ordini extends Model
{

    protected $table = 'ordini';
    protected $primaryKey = 'id_ordine';

    protected $fillable = [
        'id_utente',
        'data_ordine',
        'nome',
        'cognome',
        'indirizzo',
        'codice_postale',
        'numero_telefono',
        'note',
    ];
    public $timestamps = false;

    public function utenti()
    {
        return $this->belongsTo(User::class, 'id_utente');
    }

    public function ordiniProdotti()
    {
        return $this->hasMany(OrdiniProdotti::class, 'id_ordine');
    }
    

}
