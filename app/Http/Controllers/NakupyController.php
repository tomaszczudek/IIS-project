<?php

namespace App\Http\Controllers;

use App\Models\NakupyModel;
use Illuminate\Support\Facades\Auth;

class NakupyController extends Controller
{
    public function nakupy()
    {
        $nakupy = NakupyModel::where('user_id', Auth::user()->id)->get();
        return view('nakupy.seznam', ['nakupy' => $nakupy]);
    }

    public static function celkova_cena($id)
    {
        $nakup = NakupyModel::with('polozky.vino')->find($id);

        if (!$nakup)
            return 0;

        $celkovaCena = 0;
        foreach ($nakup->polozky as $polozka)
            $celkovaCena += ($polozka->vino->cena ?? 0) * $polozka->pocet_lahvi;

        return $celkovaCena;
    }

    public function nakup_detail($id)
    {
        $nakup = NakupyModel::with('polozky.vino')->find($id);

        if (!$nakup)
            abort(404, 'Nákup nenalezen');

        return view('nakupy.detail', compact('nakup'));
    }
}
