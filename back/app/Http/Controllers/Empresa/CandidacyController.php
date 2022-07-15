<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Vacancy;
use App\Models\Candidacy;
use Auth;

class CandidacyController extends Controller
{
    function index($vacancy_id)
    {
        $candidacy = Candidacy::orderBy('score', 'DESC')->where('vacancy_id', '=', $vacancy_id)->with('professional')->get(['score', 'professional_id', 'vacancy_id']);
        if (count($candidacy) == 0) {
            return response()->json(['msg' => 'Nenhuma candidatura registrada', 'status' => 'success',]);
        } else {
            return response()->json([$candidacy, 'status' => 'success',]);
        }
    }
}
