<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadisticaContingutModel extends Model
{
    use HasFactory;
    protected $table = 'estadistiques_contingut';
    protected $fillable = ['id_usuari','id_avis','created_at','updated_at'];
}
