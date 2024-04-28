<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllergeenController extends Controller
{
    public function __construct()
    {
    }

    public function index($id)
    {
        $result = DB::select('CALL getAllergien(?)', [$id]);
        $product = DB::select('CALL getProduct(?)', [$id]);

        if (empty($result)) {
            header("Refresh: 4; url=/overzicht");
        }

        $data = [
            'title' => 'Overzicht Allergenen',
            'product' => $product,
            'result' => $result,
        ];

        return view('allergie', $data);
    }
}
