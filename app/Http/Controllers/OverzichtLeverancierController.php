<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OverzichtLeverancierController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $result = DB::select('CALL getLeverancierIndividual()');

        $data = [
            'title' => 'Leverancier Overzicht',
            'result' => $result
        ];

        return view('leverancier-overzicht', $data);
    }
}
