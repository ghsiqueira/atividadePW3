<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/boas-vindas/{nome}', function ($nome) {
    if (preg_match('/^[a-zA-Z]{3,}$/', $nome)) {
        return "Olá, $nome! Bem-vindo(a) ao meu site! :)";
    } else {
        abort(404);
    }
})->name('hello');

Route::get('/calculadora/{numero1}/{numero2}/{operacao?}', function ($numero1, $numero2, $operacao = null) {
    if (!is_numeric($numero1) || !is_numeric($numero2)) {
        return 'Os números devem ser inteiros.';
    }
    $numero1 = (int) $numero1;
    $numero2 = (int) $numero2;
    $operacoes = ['soma', 'subtracao', 'multiplicacao', 'divisao'];
    if ($operacao && !in_array($operacao, $operacoes)) {
        return 'Operação inválida.';
    }
    $resultados = [];
    if (!$operacao || $operacao === 'soma') {
        $resultados['soma'] = $numero1 + $numero2;
    }
    if (!$operacao || $operacao === 'subtracao') {
        $resultados['subtracao'] = $numero1 - $numero2;
    }
    if (!$operacao || $operacao === 'multiplicacao') {
        $resultados['multiplicacao'] = $numero1 * $numero2;
    }
    if (!$operacao || $operacao === 'divisao') {
        if ($numero2 === 0) {
            $resultados['divisao'] = 'Não é possível dividir por zero!';
        } else {
            $resultados['divisao'] = $numero1 / $numero2;
        }
    }
    if ($operacao) {
        return $resultados[$operacao];
    } else {
        return $resultados;
    }
})->name('calcular');

Route::get('/calc-idade/{ano}/{mes?}/{dia?}', function ($ano, $mes = null, $dia = null) {
    if (!preg_match('/^\d{4}$/', $ano)) {
        return 'Ano inválido.';
    }
    if ($mes && !preg_match('/^(0?[1-9]|1[0-2])$/', $mes)) {
        return 'Mês inválido.';
    }
    if ($dia && !preg_match('/^(0?[1-9]|[1-2][0-9]|3[0-1])$/', $dia)) {
        return 'Dia inválido.';
    }
    $ano = (int) $ano;
    $mes = (int) $mes;
    $dia = (int) $dia;
    $data = sprintf('%04d-%02d-%02d', $ano, $mes, $dia);
    if (strtotime($data) > time()) {
        return 'Data futura.';
    }
    $hoje = new DateTime();
    $nascimento = new DateTime(sprintf('%04d-%02d-%02d', $ano, $mes ?: 1, $dia ?: 1));
    $idade = $hoje->diff($nascimento)->y;
    return "Idade: $idade anos.";
})->name('calcularIdade');