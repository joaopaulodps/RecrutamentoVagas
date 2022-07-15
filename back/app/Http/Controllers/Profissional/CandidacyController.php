<?php

namespace App\Http\Controllers\Profissional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidacy;
use App\Models\Professional;
use App\Models\Vacancy;
use Auth;

class CandidacyController extends Controller
{
    function store(Request $request)
    {
        $user = Auth::user();
        
        $professional = Professional::where('user_id', '=', $user->id)->first();
        $candidacy = Candidacy::where('professional_id', '=', $professional->id)->where('vacancy_id', '=', $request->vacancy_id)->get();
        if(sizeof($candidacy) === 0){
            
            $vacancy = Vacancy::where('id', '=', $request->vacancy_id)->first();
            $experiencia = $professional->experiencia;
            $localProfissional = $professional->localizacao;
            $nivel = $vacancy->nivel;
            $localVaga = $vacancy->localizacao;
    
            $distancia = $localVaga.$localProfissional;
    
            $AB = $BA = 5;
            $BC = $CB = 7;
            $BD = $DB = 3;
            $CE = $EC = 4;
            $DE = $ED = 10;
            $DF = $FD = 8;
    
            if($distancia === "ab" || $distancia === "ba"){
                $disTotal = $AB;
            }
            elseif($distancia === "ac" || $distancia === "ca"){
                $disTotal = $AB + $BC;
            }
            elseif($distancia === "ad" || $distancia === "da"){
                $disTotal = $AB + $BD;
            }
            elseif($distancia === "ae" || $distancia === "ea"){
                $disTotal1 = $AB + $BC + $CE;
                $disTotal2 = $AB + $BD + $DE;
                if($disTotal1 > $disTotal2){
                    $disTotal = $disTotal2;
                }
                else{
                    $disTotal = $disTotal1;
                }
            }
            elseif($distancia === "af" || $distancia === "fa"){
                $disTotal1 = $AB + $BC + $CE + $ED + $DF;
                $disTotal2 = $AB + $BD + $DF;
                if($disTotal1 > $disTotal2){
                    $disTotal = $disTotal2;
                }
                else{
                    $disTotal = $disTotal1;
                }
            }
            elseif($distancia === "bc" || $distancia === "cb"){
                $disTotal = $BC;
            }
            elseif($distancia === "bd" || $distancia === "db"){
                $disTotal1 = $BD;
                $disTotal2 = $BC + $CE + $ED;
                if($disTotal1 > $disTotal2){
                    $disTotal = $disTotal2;
                }
                else{
                    $disTotal = $disTotal1;
                }
            }
            elseif($distancia === "be" || $distancia === "eb"){
                $disTotal1 = $BC + $CE;
                $disTotal2 = $BD + $DE;
                if($disTotal1 > $disTotal2){
                    $disTotal = $disTotal2;
                }
                else{
                    $disTotal = $disTotal1;
                }
            }
            elseif($distancia === "bf" || $distancia === "fb"){
                $disTotal1 = $BD + $DF;
                $disTotal2 = $BC + $CE + $ED + $DF;
                if($disTotal1 > $disTotal2){
                    $disTotal = $disTotal2;
                }
                else{
                    $disTotal = $disTotal1;
                }
            }
            elseif($distancia === "cd" || $distancia === "dc"){
                $disTotal1 = $CB + $BD + $DF;
                $disTotal2 = $CE + $ED + $DF;
                if($disTotal1 > $disTotal2){
                    $disTotal = $disTotal2;
                }
                else{
                    $disTotal = $disTotal1;
                }
            }
            elseif($distancia === "ce" || $distancia === "ec"){
                $disTotal1 = $CE;
                $disTotal2 = $CB + $BD + $DE;
                if($disTotal1 > $disTotal2){
                    $disTotal = $disTotal2;
                }
                else{
                    $disTotal = $disTotal1;
                }
            }
            elseif($distancia === "cf" || $distancia === "fc"){
                $disTotal1 = $CB + $BD + $DF;
                $disTotal2 = $CE + $ED + $DF;
                if($disTotal1 > $disTotal2){
                    $disTotal = $disTotal2;
                }
                else{
                    $disTotal = $disTotal1;
                }
            }
            elseif($distancia === "de" || $distancia === "ed"){
                $disTotal1 = $DE;
                $disTotal2= $DB + $BC + $CE;
                if($disTotal1 > $disTotal2){
                    $disTotal = $disTotal2;
                }
                else{
                    $disTotal = $disTotal1;
                }
            }
            elseif($distancia === "df" || $distancia === "fd"){
                $disTotal = $DF;
            }
            elseif($distancia === "fe" || $distancia === "ef"){
                $disTotal1 = $ED + $DF;
                $disTotal2 = $EC + $CB + $BD + $DF;
                if($disTotal1 > $disTotal2){
                    $disTotal = $disTotal2;
                }
                else{
                    $disTotal = $disTotal1;
                }
            }
            else{
                  $disTotal = 0;
            }
    
            if($disTotal <= 5){
                $D = 100;
            }
            elseif($disTotal >5 && $disTotal <=10){
                $D = 75;
            }
            elseif($disTotal >10 && $disTotal <=15){
                $D = 50;
            }
            elseif($disTotal >15 && $disTotal <=20){
                $D = 25;
            }
            elseif($disTotal >20){
                $D = 0;
            }
    
            $NV = $nivel - $experiencia;
    
            $N = 100 - 25 * abs($NV);
    
            $S = ($N + $D)/2;
            $score = ceil($S);
            
            $candidacy = new Candidacy;
            $candidacy->vacancy_id = $request->vacancy_id;
            $candidacy->professional_id = $professional->id;
            $candidacy->score = $score;
            $candidacy->save();
            
            return response()->json(['msg' => 'Candidatura registrada. Boa Sorte!', 'status' => 'success',]);
        }
        else{
            return response()->json([$candidacy, 'msg' => 'Você já se candidatou a essa vaga', 'status' => 'error']);
        }
    }
}
