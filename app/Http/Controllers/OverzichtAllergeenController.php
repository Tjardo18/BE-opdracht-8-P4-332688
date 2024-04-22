<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OverzichtAllergeenController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $result = DB::select('CALL getProductAllergenenInfo()');

        $data = [
            'title' => 'Allergenen Overzicht',
            'result' => $result
        ];

        return view('allergeen-overzicht', $data);
    }

    public function filterByAllergie(Request $request)
    {
        $result = DB::select('CALL getProductAllergenenInfoByAllergen(?)', [$request->filter_allergie]);

        $data = [
            'title' => 'Allergenen Overzicht',
            'result' => $result
        ];

        return view('allergeen-overzicht', $data);
    }
}
