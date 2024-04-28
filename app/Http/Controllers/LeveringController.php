<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeveringController extends Controller
{

    public function __construct()
    {
    }

    public function index($id)
    {
        $result = DB::select('CALL getLeveringen(?)', [$id]);
        $leverancier = DB::select('CALL getLeverancierById(?)', [$id]);

        if (empty($result)) {
            header("Refresh: 3; url=/leverancier-overzicht");
        }

        $data = [
            'title' => 'Geleverde Producten',
            'leverancier' => $leverancier,
            'result' => $result,
        ];

        return view('leveringen', $data);
    }
}
