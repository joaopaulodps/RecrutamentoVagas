<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use StdClass;

use App\Models\Professional;
use App\Models\Company;
use App\Models\Address;
use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function professionalStore(Request $request)
    {
        if(!$request->nome || !$request->email || !$request->senha || !$request->profissao ||
           !$request->experiencia || !$request->endereco)
        {
            return response()->json(['msg' => 'Preencha todos os campos', 'status' => 'error',]);
        }
        else
        {
            $check_email = User::where('email', '=', $request->email)->first();

            if ($check_email != null) {

                return response()->json(['msg' => 'Email Já cadastrado', 'status' => 'error',]);
            } 
            else {

                $user = new User;
                $user->password = Hash::make($request->senha);
                $user->email = $request->email;

                $user->save();

                $professional = new Professional;
                $professional->fill($request->all());
                $professional->user_id = $user->id;

                $professional->save();

                $data = new StdClass;
                $data->nome = $user->name;
                $data->email = $user->email;

                $user->roles()->attach(2);

                return response()->json(['msg' => 'Cadastro realizado com sucesso', 'status' => 'success']);
            }
        }
    }

    public function companyStore(Request $request)
    {
        if(!$request->nome || !$request->email || !$request->senha || !$request->empresa)
        {
            return response()->json(['msg' => 'Preencha todos os campos', 'status' => 'error',]);
        }
        else
        {
            $check_email = User::where('email', '=', $request->email)->first();
            
            if ($check_email != null) {
                
                return response()->json(['msg' => 'E-mail Já cadastrado', 'status' => 'error']);
                
            } 
            else {
                
                $user = new User;
                $user->password = Hash::make($request->senha);
                $user->email = $request->email;
                
                $user->save();
                
                $company = new Company;
                $company->fill($request->all());
                $company->user_id = $user->id;
                
                $company->save();
                
                $data = new StdClass;
                $data->nome = $user->name;
                $data->email = $user->email;
                
                $user->roles()->attach(1);
                
                return response()->json(['msg' => 'Cadastro realizado com sucesso', 'status' => 'success']);
            }
        }
    }
        
}
