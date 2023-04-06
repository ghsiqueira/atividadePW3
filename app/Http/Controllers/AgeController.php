<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class AgeController extends Controller
{
    public function idade($ano, $mes = null, $dia = null)
    {
        if (!preg_match('/^\d{4}$/', $ano) || ($mes && !preg_match('/^\d{1,2}$/', $mes)) || ($dia && !preg_match('/^\d{1,2}$/', $dia))) {
            return 'Formato de data inválido';
        }

        if ($mes && ($mes < 1 || $mes > 12)) {
            return 'Mês inválido';
        }

        if ($dia && ($dia < 1 || $dia > 31)) {
            return 'Dia inválido';
        }

        $dataNascimento = Carbon::createFromFormat('Y-m-d', sprintf('%04d-%02d-%02d', $ano, $mes ?: 1, $dia ?: 1));

        if ($dataNascimento->isFuture()) {
            return 'Data no futuro';
        }

        $idade = $dataNascimento->age;

        return "A idade é $idade anos.";
    }
}