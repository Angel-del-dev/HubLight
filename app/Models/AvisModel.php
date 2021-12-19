<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvisModel extends Model
{
    use HasFactory;
    protected $table = 'avis';
    protected $primaryKey = 'id';
    protected $fillable = ['explicacio','gravetat','created_at','updated_at'];
}
