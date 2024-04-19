<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OverzichtController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $result = DB::select('CALL getOverzicht()');

        $data = [
            'title' => 'Overzicht Magazijn Jamin',
            'result' => $result,
        ];

        return view('overzicht', $data);
    }
}
