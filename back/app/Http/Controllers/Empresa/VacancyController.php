<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\Company;
use App\Models\Candidacy;
use Auth;

class VacancyController extends Controller
{
    function index()
    {
        $user = Auth::user();
        $company = Company::where('user_id', '=', $user->id)->first();
        $vacancy = Vacancy::where('company_id', '=', $company->id)->get();
        
        if (count($vacancy) == 0) {
            return response()->json(['msg' => 'Nenhuma vaga cadastrada', 'status' => 'success',]);
        } else {
            return response()->json([$vacancy, 'status' => 'success',]);
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $company = Company::where('user_id', '=', $user->id)->first();

        if(!$request->titulo || !$request->descricao || !$request->nivel || 
           !$request->endereco)
        {
            return response()->json(['msg' => 'Preencha todos os campos', 'status' => 'error']);
        }
        else
        {
            $vacancy = new Vacancy;
            $vacancy->fill($request->all());
            $vacancy->company_id = $company->id;
            $vacancy->save();
            
            return response()->json(['msg' => 'Vaga cadastrada com sucesso', 'status' => 'success',]);
            
        }
    }
    public function edit($vacancy_id)
    {
            $user_id = Auth::user()->id;
        $company = Company::where('user_id', '=', $user_id)->first();

        $vacancy = Vacancy::where('id', '=', $vacancy_id)->where('company_id', '=', $company->id)->first();

        if ($vacancy == null) {
            return response()->json(['msg' => 'Vaga não encontrada', 'status' => 'success',]);
        } else {
            return response()->json([$vacancy, 'status' => 'success',]);
        }
    }

    public function update(Request $request)
    {
        if(!$request->titulo || !$request->descricao || !$request->nivel)
        {
            return response()->json(['msg' => 'Preencha todos os campos', 'status' => 'error']);
        }
        else
        {
            $vacancy = Vacancy::find($request->id);
            $vacancy->fill($request->all());
            $vacancy->update();
            return response()->json(['msg' => 'Vaga atualizada com sucesso', 'status' => 'success',]);
        }
    }

    public function delete($vacancy_id)
    {
        $user_id = Auth::user()->id;
        $company = Company::where('user_id', '=', $user_id)->first();
        $candidacy = Candidacy::where('vacancy_id', '=', $vacancy_id)->get();

        $vacancy = Vacancy::where('id', '=', $vacancy_id)->where('company_id', '=', $company->id)->first();
        if ($vacancy != null) {
            Candidacy::destroy($candidacy);
            $vacancy->delete();
            return response()->json(['msg' => 'Vaga deletada com sucesso', 'status' => 'success',]);
        } else {
            return response()->json(['msg' => 'Nenhuma vaga encontrada', 'status' => 'error',]);
        }
    }
}
