<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodotti extends Model
{
    protected $table = 'prodotti';
    protected $primaryKey = 'id';
    protected $fillable = ['nome', 'immagine', 'descrizione', 'prezzo'];
    public $timestamps = false;
}

