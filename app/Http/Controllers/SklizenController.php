<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SklizenModel;
use App\Models\RadkyModel;
use App\Models\OsetreniModel;
use Carbon\Carbon;

class SklizenController extends Controller
{
    public function sklizen()
    {
        $sklizne = SklizenModel::all();
        $osetreni = OsetreniModel::with('radky')
        ->where('stav', false)
        ->where('typ_enum', '=',5)
        ->orderBy('datum', 'asc')
        ->get();

        return view('sklizen.seznam', ['sklizne' => $sklizne, 'osetreni' => $osetreni]);
    }

    public function detail($id)
    {
        $sklizen = SklizenModel::with('vina')->find($id);
        if (!$sklizen) 
            abort(404, 'Sklizeň nenalezena');
        return view('sklizen.detail', ['sklizen' => $sklizen]);
    }

    public function create(Request $request)
    {
        $radky_id = $request->input('radky_id');
        $osetreni_id = $request->input('osetreni_id');
        $limit = Carbon::now()->subWeeks(2);
        
        $posledni_postrik = OsetreniModel::where('radky_id', $radky_id)
            ->where('typ_enum', 3)
            ->where('stav', true)
            ->where('datum_provedeni', '>=', $limit)
            ->latest('datum_provedeni')
            ->first();
        
        if ($posledni_postrik)
            return redirect()->back()->with('error', 'Na tomto řádku byl proveden postřik v posledních 2 týdnech!');
        
        return view('sklizen.create', ['radky_id' => $radky_id,'osetreni_id' => $osetreni_id]);
    }

    public function store(Request $request)
    {
        $osetreni = OsetreniModel::find($request->input('osetreni_id'));
        $osetreni->stav = true;
        $osetreni->datum_provedeni = Carbon::today();
        $osetreni->save();

        $odruda = RadkyModel::find($request->input('radky_id'))->odruda_enum;
        $sklizen = SklizenModel::insert([
            'radek_id' => $request->input('radky_id'),
            'hmotnost_hroznu_kg' => $request->input('hmotnost_hroznu_kg'),
            'litry_vina' => $request->input('litry_vina'),
            'odruda_hroznu' => $odruda,
            'cukernatost_hroznu' => $request->input('cukernatost_hroznu'),
            'datum_sklizne' => Carbon::today(),
        ]);

        return redirect('/sklizen/seznam')->with('success', 'Sklizeň byla zaznamenána!');
    }

    public function edit($id)
    {
        $sklizen = SklizenModel::find($id);
        if (!$sklizen) 
            abort(404, 'Sklizeň nenalezena');
        return view('sklizen.edit', ['sklizen' => $sklizen]);
    }

    public function update(Request $request, $id)
    {
        $sklizen = SklizenModel::find($id);
        if (!$sklizen)
            abort(404, 'Sklizeň nenalezena');

        $sklizen->update([
            'datum_sklizne' => $request->input('datum_sklizne'),
            'hmotnost_hroznu_kg' => $request->input('hmotnost_hroznu_kg'),
            'litry_vina' => $request->input('litry_vina'),
            'cukernatost_hroznu' => $request->input('cukernatost_hroznu'),
        ]);

        return redirect('/sklizen/detail-' . $id)->with('success', 'Sklizeň byla aktualizována!');
    }
}
