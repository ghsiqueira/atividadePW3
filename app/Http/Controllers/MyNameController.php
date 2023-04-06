<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyNameController extends Controller
{
    public function hello($name) {
    return "Olá, $name! Bem-vindo ao meu site.";
    }
}