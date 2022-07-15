<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Rota de login */
Route::post('login',[App\Http\Controllers\AuthController::class, 'login'])->name('login');

/* Vagas na página inicial do site */
Route::get('index',[App\Http\Controllers\VacancyController::class, 'index']);

/* Registro de profissionais e empresas/recrutadores */
Route::post('professional/store',[App\Http\Controllers\RegisterController::class, 'professionalStore']);
Route::post('company/store',[App\Http\Controllers\RegisterController::class, 'companyStore']);

/* Rotas de dados da empresa/recrutador */
Route::get('company/edit',[App\Http\Controllers\Empresa\CompanyController::class, 'edit']);
Route::post('company/update',[App\Http\Controllers\Empresa\CompanyController::class, 'update']);

/* Rotas de vagas na área de empresa/recrutador */
Route::get('vacancy/index', [App\Http\Controllers\Empresa\VacancyController::class, 'index']);
Route::post('vacancy/store', [App\Http\Controllers\Empresa\VacancyController::class, 'store']);
Route::get('vacancy/{id}/edit', [App\Http\Controllers\Empresa\VacancyController::class, 'edit']);
Route::post('vacancy/{id}/update', [App\Http\Controllers\Empresa\VacancyController::class, 'update']);
Route::post('vacancy/{id}/delete', [App\Http\Controllers\Empresa\VacancyController::class, 'delete']);
Route::get('vacancy/{id}/candidacy/index', [App\Http\Controllers\Empresa\CandidacyController::class, 'index']);

/* Rotas de dados do profissional */
Route::get('professional/edit', [App\Http\Controllers\Profissional\ProfessionalController::class, 'edit']);
Route::post('professional/update', [App\Http\Controllers\Profissional\ProfessionalController::class, 'update']);

/* Rotas de vagas na área do profissional */
Route::get('professional/vacancy/index', [App\Http\Controllers\Profissional\VacancyController::class, 'index']);
Route::get('professional/vacancy/{id}/edit', [App\Http\Controllers\Profissional\VacancyController::class, 'edit']);
Route::post('vacancy/candidacy/store', [App\Http\Controllers\Profissional\CandidacyController::class, 'store']);

