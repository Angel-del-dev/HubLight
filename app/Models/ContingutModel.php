<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContingutModel extends Model
{
    use HasFactory;
    protected $table = 'contingut';
    protected $primaryKey = 'id';
    protected $fillable = ['titulo','portada','link_copyright','url','descripcio','majoria_edat','reportat','propietari','tipus_contingut','drets_autor','created_at','updated_at'];
}
