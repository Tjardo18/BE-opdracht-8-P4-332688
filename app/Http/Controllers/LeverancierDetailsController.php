<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Leverancier;
use App\Models\Magazijn;
use App\Models\ProductPerLeverancier;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LeverancierDetailsController extends Controller
{

    public function __construct()
    {
    }

    public function index($id)
    {
        $result = DB::select('CALL getLeverancierInfo(?)', [$id]);

        $data = [
            'title' => 'Leverancier Details',
            'LId' => $id,
            'result' => $result,
        ];

        return view('leverancier-details', $data);
    }

    public function store()
    {
        Leverancier::where('id', request('leverancierId'))
            ->update([
                'naam' => request('naam'),
                'contactPersoon' => request('contactPersoon'),
                'leverancierNummer' => request('leverancierNummer'),
                'mobiel' => request('mobiel'),
                'updated_at' => Carbon::now(),
            ]);

        Contact::where('id', request('contactId'))
            ->update([
                'straat' => request('straatnaam'),
                'huisnummer' => request('huisnummer'),
                'postcode' => request('postcode'),
                'stad' => request('stad'),
                'updated_at' => Carbon::now(),
            ]);

        return redirect(route('leverancier-overzicht.index'));
    }
}
