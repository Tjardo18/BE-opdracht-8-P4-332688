<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeverancierController extends Controller
{

    public function __construct()
    {
    }

    public function index($id)
    {
        $result = DB::select('CALL getLeverancier(?)', [$id]);

        if ($result[0]->AantalAanwezig == 0) {
            header("Refresh: 4; url=/overzicht");
        }

        $data = [
            'title' => 'Leverings Informatie',
            'result' => $result,
        ];

        return view('leverancier', $data);
    }
}
