<?php

namespace App\Http\Controllers\Profissional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\Professional;

class VacancyController extends Controller
{
    public function index()
    {
        $all_vacancy = Vacancy::select('id', 'titulo', 'descricao', 'nivel')->get();
        if (sizeof($all_vacancy) == 0) {

            return response()->json(['msg' => 'Nenhuma vaga encontrada', 'status' => 'success']);
        } else {

            return response([$all_vacancy, 'status' => 'success']);
        }
    }

    public function edit($id)
    {
        $vacancy = Vacancy::where('id', '=', $id)->with('company')->first();
        
        return response()->json(['vacancy'=> $vacancy, 'status' => 'success',]);
    }

    
}
