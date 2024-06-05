<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedaProdotti extends Model
{
    use HasFactory;
    protected $table = 'schedaProdotti';
    protected $primaryKey = 'prodotto_id';
    public $timestamps = false;
}

