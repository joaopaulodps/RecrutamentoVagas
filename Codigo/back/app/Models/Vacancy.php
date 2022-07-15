<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'nivel', 'localizacao', 'endereco', 'company_id'];

    public function candidacies()
    {
        return $this->hasMany('\App\Models\Candidacy');
    }

    public function company()
    {
        return $this->belongsTo('\App\Models\Company');
    }
    
}
