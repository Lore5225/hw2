<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soluzioni extends Model
{
    use HasFactory;
    protected $table = 'Soluzioni';
    protected $primaryKey = 'soluzioni_id';
    public $timestamps = false;
}
