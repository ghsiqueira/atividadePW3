<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function operacao($num1, $num2, $operation = null) {
        if ($operation) {
            switch ($operation) {
                case 'soma':
                    $result = $num1 + $num2;
                    break;
                case 'subtracao':
                    $result = $num1 - $num2;
                    break;
                case 'multiplicacao':
                    $result = $num1 * $num2;
                    break;
                case 'divisao':
                    if ($num2 == 0) {
                        return 'Erro: Não existe divisão por zero.';
                    } else {
                        $result = $num1 / $num2;
                    }
                    break;
                default:
                    return 'Erro: Operação inválida.';
            }
            return "O resultado da operação $operation entre $num1 é $num2: $result";
        } else {
            $soma = $num1 + $num2;
            $subtracao = $num1 - $num2;
            $multiplicacao = $num1 * $num2;
            if ($num2 == 0) {
                $divisao = 'Erro: Não existe divisão por zero.';
            } else {
                $divisao = $num1 / $num2;
            }
            return "Resultados das operações com $num1 e $num2: <br><br> Soma = $soma <br> Subtração = $subtracao <br>
            Multiplicação = $multiplicacao <br> Divisão = $divisao";
        }
    }
}
