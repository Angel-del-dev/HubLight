<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalitiquesGeneralsModel extends Model
{
    use HasFactory;
    protected $table = 'analitiques_generals';
    protected $primaryKey = 'id';
    protected $fillable = ['usuaris_suspes','usuaris_actius','usuaris_enperill',"contenido_total","missatges_totals"];
    protected $hidden= ["updated_at"];
}
