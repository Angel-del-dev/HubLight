<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvisUsuariModel extends Model
{
    use HasFactory;
    protected $table = 'avis_usuari';
    protected $primaryKey= "id";
    protected $fillable = ['id_usuari','id_avis','removed','created_at','updated_at'];
}
