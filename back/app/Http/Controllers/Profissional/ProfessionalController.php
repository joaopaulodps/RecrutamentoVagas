<?php

namespace App\Http\Controllers\Profissional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfessionalController extends Controller
{
    public function edit(Request $request)
    {

        $user_id = Auth::user()->id;
        $professional = Professional::where('user_id', $user_id)->with('user')->first();

        if (!$professional) {
            return response()->json(['msg' => 'Usuário não encontrado!', 'status' => 'error']);
        } else {
            return response(['professional' => [$professional], 'status' => 'success']);
        }
    }

    public function update(Request $request)
    {

        $user = Auth::user();

        if(!$request->nome || !$request->profissao ||
           !$request->experiencia || !$request->endereco)
        {
            return response()->json(['msg' => 'Preencha todos os campos', 'status' => 'error',]);
        }
        else
        {            
            if ($request->senha) {
                $user->password  = Hash::make($request->senha);
            }
            
            $user->update();
            
            $professional = Professional::where('user_id', $user->id)->with('user')->first();
            
            $professional->nome = $request->nome;
            $professional->profissao = $request->profissao;
            $professional->experiencia = $request->experiencia;
            $professional->endereco = $request->endereco;
            $professional->update();
            
            return response()->json(['professional' => $professional, 'msg' => 'Dados salvos com sucesso!', 'status' => 'success']);
        }
    }
}
