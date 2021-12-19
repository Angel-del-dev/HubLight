<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadisticaModel extends Model
{
    use HasFactory;
    protected $table = 'estadistiques';
    protected $primaryKey = 'id_estadistica';
    protected $fillable = ['created_at','updated_at'];
}
