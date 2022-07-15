<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'profissao', 'experiencia', 'localizacao', 'endereco', 'user_id'];

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function candidacies()
    {
        return $this->hasMany('\App\Models\Candidacy');
    }
}