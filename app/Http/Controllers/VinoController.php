<?php

namespace App\Http\Controllers;

use App\Models\VinoModel;
use App\Models\SklizenModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VinoController extends Controller
{
    public function nabidka()
    {
        $vina = VinoModel::all();
        return view('nabidka.seznam', ['vina' => $vina]);
    }

    public function nabidka_detail($id)
    {
        $vino = VinoModel::with('sklizen')->find($id);
        if (!$vino)
            abort(404, 'Víno nenalezeno');

        return view('nabidka.detail', compact('vino'));
    }

    public function vino()
    {
        $vina = VinoModel::all();
        return view('vino.seznam', ['vina' => $vina]);
    }

    public function vino_detail($id)
    {
        $vino = VinoModel::with('sklizen')->find($id);
        if (!$vino)
            abort(404, 'Víno nenalezeno');

        return view('vino.detail', compact('vino'));
    }

    public function store(Request $request)
    {
        $sklizen = SklizenModel::find($request->input('sklizen_id'));
        if (!$sklizen)
            abort(404, 'Sklizeň nenalezena');

        $sklizen->update(['litry_vina' => $sklizen->litry_vina - ($request->input('pocet_lahvi') * 0.75)]);
        $rocnik = Carbon::parse($sklizen->datum_sklizne);

        VinoModel::insert([
            'sklizen_id' => $request->input('sklizen_id'),
            'rocnik' => $rocnik->year,
            'odruda' => $sklizen->odruda_hroznu,
            'procento_alkoholu' => $request->input('procento_alkoholu'),
            'pocet_vyrobenych_lahvi' => $request->input('pocet_lahvi'),
            'pocet_zbylych_lahvi' => $request->input('pocet_lahvi'),
            'cena' => $request->input('cena'),
        ]);

        return redirect()->back()->with('success', 'Víno bylo úspěšně lahvováno!');
    }

    public function edit($id)
    {
        $vino = VinoModel::find($id);
        if (!$vino)
            abort(404, 'Víno nenalezeno');
        return view('vino.edit', ['vino' => $vino]);
    }

    public function update(Request $request, $id)
    {
        $vino = VinoModel::find($id);
        if (!$vino)
            abort(404, 'Víno nenalezeno');

        $vino->update([
            'procento_alkoholu' => (float) $request->input('procento_alkoholu'),
            'pocet_vyrobenych_lahvi' => (int) $request->input('pocet_vyrobenych_lahvi'),
            'pocet_zbylych_lahvi' => (int) $request->input('pocet_zbylych_lahvi'),
            'cena' => (float) $request->input('cena'),
        ]);

        return redirect("/vino/detail-{$id}")->with('success', 'Vína byla úspěšně aktualizována!');
    }

    public function stahnout($id)
    {
        $vino = VinoModel::find($id);
        if (!$vino)
            abort(404, 'Víno nenalezeno');

        $vino->update([
            'pocet_zbylych_lahvi' => 0,
        ]);

        return redirect("/vino/detail-{$id}")->with('success', 'Víno bylo staženo z nabídky!');
    }
}