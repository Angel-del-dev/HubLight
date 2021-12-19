<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContingutTagModel extends Model
{
    use HasFactory;
    protected $table = 'contingut_tag';
    protected $primaryKey = 'id';
    protected $fillable = ["id_contingut","id_tag","created_at","updated_at"];
}
