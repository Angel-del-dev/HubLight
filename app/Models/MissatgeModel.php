<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissatgeModel extends Model
{
    use HasFactory;
    protected $table = 'missatge';
    protected $primaryKey = 'id';
    protected $fillable = ['missatge',"id_xat",'id_usuari','id_contingut'];
    // protected $hidden= ["updated_at"];
}
