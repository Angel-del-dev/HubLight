<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XatModel extends Model
{
    use HasFactory;
    protected $table = 'xat';
    protected $primaryKey = 'id';
    protected $fillable = ['nom',"url_foto"];
    // protected $hidden= ["updated_at"];
}
