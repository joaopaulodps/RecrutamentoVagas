<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidacy extends Model
{
    use HasFactory;

    protected $fillable = ['vacancy_id', 'professional_id', 'score'];

    public function vacancies()
    {
        return $this->belongsToMany('\App\Models\Vacancy');
    }
    public function professional()
    {
        return $this->belongsTo('\App\Models\Professional');
    }
    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

}
