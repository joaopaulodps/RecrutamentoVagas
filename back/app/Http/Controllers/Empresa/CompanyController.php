<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function edit(Request $request)
    {

        $user_id = Auth::user()->id;
        $company = Company::where('user_id', $user_id)->with('user')->first();

        if (!$company) {
            return response()->json(['msg' => 'Usuário não encontrado!', 'status' => 'error']);
        } else {
            return response(['company' => [$company], 'status' => 'success']);
        }
    }

    public function update(Request $request)
    {

        $user = Auth::user();

        if(!$request->nome || !$request->empresa)
        {
            return response()->json(['msg' => 'Preencha todos os campos obrigatórios', 'status' => 'error',]);
        }
        else
        {            
            if ($request->senha) {
                $user->password  = Hash::make($request->senha);
            }
            
            $user->update();
            
            $company = Company::where('user_id', $user->id)->with('user')->first();
            
            $company->empresa = $request->empresa;
            $company->nome = $request->nome;
            $company->update();
            
            return response()->json(['company' => $company, 'msg' => 'Dados salvos com sucesso!', 'status' => 'success']);
        }
    }
}
