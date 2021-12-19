<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XatUsuarisModel extends Model
{
    use HasFactory;
    protected $table = 'xat_usuaris';
    protected $primaryKey = 'id';
    protected $fillable = ['id_xat',"id_usuari",'lastseen'];
    // protected $hidden= ["updated_at"];
}
