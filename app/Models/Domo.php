<?php

namespace App\Models;

use App\Models\Caracteristica;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domo extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function caracteristicaDomo(){
        return $this->belongsTo(Caracteristica::class, 'idCaracteristicas');
    }
}
