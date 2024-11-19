<?php

namespace App\Http\Controllers\Tasas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TasaDePlanController extends Controller
{
    public function tasas_index()
    {
        return view('tasa_de_plan.tasas-index');
    }
}
