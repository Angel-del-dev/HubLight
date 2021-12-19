<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoContenidoModel extends Model
{
    use HasFactory;
    protected $table = 'tipus_contingut';
    protected $primaryKey = 'id';
    protected $fillable = ["tipus","espai","created_at","updated_at","Descripcio","icona"];
    protected $hidden = ['created_at','updated_at'];
}
