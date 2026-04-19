<?php

namespace App\Http\Controllers;

use App\Models\OsetreniModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OsetreniController extends Controller
{
    public function osetreni()
    {
        $radky = OsetreniModel::with('radky')
            ->where('stav', false)
            ->where('typ_enum', '<=', 4)
            ->orderBy('datum', 'asc')
            ->get();
        foreach ($radky as $r) {
            $r->druh_text = self::ODRUDA_TYP[$r->radky->odruda_enum] ?? 'Neznámý druh';
            $r->typ_text = self::PLANOVANA_AKCE_TYP[$r->typ_enum] ?? 'Neznámé ošetření';
        }
        return view('osetreni', ['radky' => $radky]);
    }

    public function akce_done(Request $request)
    {
        if ($request->idDetail != null) {
            $osetreni = OsetreniModel::with('radky')->find($request->idDetail);
            $osetreni->druh_text = self::ODRUDA_TYP[$osetreni->radky->odruda_enum] ?? 'Neznámý druh';
            $osetreni->typ_text = self::PLANOVANA_AKCE_TYP[$osetreni->typ_enum] ?? 'Neznámé ošetření';
            if ($osetreni->stav == false) {
                $datumOsetreni = Carbon::parse($osetreni->datum);
                $osetreni->stav_text = $datumOsetreni->gt(Carbon::now()) || $datumOsetreni->isToday() ? "Nevyřízeno" : "Nevyřízeno (Po termínu)";
            } else {
                $osetreni->stav_text = $osetreni-> datum < $osetreni->datum_provedeni ? "Vyřízeno (Po termínu)" : "Vyřízeno";
            }

            return view('osetreni-detail', ['osetreni' => $osetreni]);
        }
        if ($request->idDelete != null) {
            $osetreni = OsetreniModel::find($request->idDelete);
            $osetreni->delete();
            return redirect()->back()->with('success', '');
        }
        if ($request->id != null) {
            $osetreni = OsetreniModel::find($request->id);
            $osetreni->stav = true;
            $osetreni->datum_provedeni = Carbon::now()->toDateString();
            $osetreni->save();
            return redirect()->back()->with('success', '');
        }
        return redirect()->back()->with('failure', '');
    }

}
