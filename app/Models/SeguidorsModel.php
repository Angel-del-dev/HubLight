<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguidorsModel extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'seguidors';
    protected $fillable = ['id_usuari','id_seguit','acceptat','created_at','updated_at'];
}
