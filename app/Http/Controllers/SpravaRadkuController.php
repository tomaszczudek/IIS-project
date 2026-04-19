<?php

namespace App\Http\Controllers;

use App\Models\RadkyModel;
use Illuminate\Http\Request;


class SpravaRadkuController extends Controller
{
    public function radky()
    {
        $radky = RadkyModel::get();
        foreach ($radky as $r) {
            $r->druh_text = self::ODRUDA_TYP[$r->odruda_enum] ?? 'Neznámý druh';
        }
        return view('radky', ['radky' => $radky]);
    }

    public function radky_detail(Request $request)
    {
        if ($request->id == null) {
            $radek = (object) [
                'id' => null,
                'odruda_enum' => "",
                'pocet_hlav' => "",
                'rok_vysadby' => "",
            ];
            return view('radky-detail', ['radek' => $radek, 'druhy' => self::ODRUDA_TYP]);
        }
        $radek = RadkyModel::find($request->input('id'));
        return view('radky-detail', ['radek' => $radek, 'druhy' => self::ODRUDA_TYP]);
    }

    public function radky_update(Request $request)
    {
        if ($request->id == null) {
            RadkyModel::query()->insert(
                [
                    'odruda_enum' => $request->odruda_enum,
                    'rok_vysadby' => $request->rok_vysadby,
                    'pocet_hlav' => $request->pocet_hlav,
                ]
            );
            return redirect('/radky')->with('success', 'Řádek byl úspěšně přídán.');
        }
        $radek = RadkyModel::find($request->id);
        $radek->odruda_enum = $request->odruda_enum;
        $radek->pocet_hlav = $request->pocet_hlav;
        $radek->rok_vysadby = $request->rok_vysadby;
        $radek->save();
        return redirect('/radky')->with('success', 'Řádek byl úspěšně upraven.');
    }
}
