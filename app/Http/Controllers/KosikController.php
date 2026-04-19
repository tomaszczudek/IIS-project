<?php

namespace App\Http\Controllers;

use App\Models\NakupyModel;
use Illuminate\Http\Request;
use App\Models\VinoModel;

class KosikController extends Controller
{
    public function zobraz()
    {
        $kosik = session()->get('kosik', []);
        return view('kosik', ['kosik' => $kosik]);
    }

    public function pridej(Request $request)
    {
        $kosik = session()->get('kosik', []);

        $vino_id = $request->input('vino_id');
        $pocet = $request->input('pocet', 1);

        if (isset($kosik[$vino_id])) 
        {
            $kosik[$vino_id]['pocet'] += $pocet;
        } 
        else 
        {
            $kosik[$vino_id] = [
                'vino_id' => $vino_id,
                'pocet' => $pocet,
            ];
        }

        session()->put('kosik', $kosik);
        session()->flash('success', 'Víno přidáno do košíku!');

        return redirect('/nabidka/detail-' . $vino_id);
    }

    public function odeber($vino_id)
    {
        $kosik = session()->get('kosik', []);

        if (isset($kosik[$vino_id]))
            unset($kosik[$vino_id]);

        session()->put('kosik', $kosik);
        session()->flash('success', 'Víno odebráno z košíku!');

        return redirect('/kosik');
    }

    public function zmena_poctu(Request $request)
    {
        $kosik = session()->get('kosik', []);

        $vino_id = $request->input('vino_id');
        $pocet = $request->input('pocet', 1);

        $vino = VinoModel::find($vino_id);

        if (!$vino)
            return redirect('/kosik')->with('error', 'Víno neexistuje!');

        $dostpny_pocet = $vino->pocet_zbylych_lahvi;

        if ($pocet > $dostpny_pocet)
            return redirect('/kosik')->with('error', 'Počet dostupných lahví je ' . $dostpny_pocet . '!');

        $pocet = max(1, min($pocet, $vino->pocet_zbylych_lahvi));

        if (isset($kosik[$vino_id]))
        {
            $kosik[$vino_id]['pocet'] = $pocet;
            session()->put('kosik', $kosik);
            session()->flash('success', 'Počet aktualizován!');
        }

        return redirect('/kosik');
    }

    public function vytvorit_nakup(Request $request)
    {
        if (!auth()->check())
            return redirect('/login')->with('error', 'Musíte být přihlášeni pro vytvoření objednávky!');

        $kosik = session()->get('kosik', []);

        if (empty($kosik))
            return redirect('/kosik')->with('error', 'Košík je prázdný!');

        $nakup = NakupyModel::create([
            'user_id' => auth()->id(),
            'datum_nakupu' => now(),
        ]);

        foreach ($kosik as $polozka)
        {
            $vino = VinoModel::find($polozka['vino_id']);
            if ($vino)
            {
                $vino->pocet_zbylych_lahvi -= $polozka['pocet'];
                $vino->save();
            }

            $nakup->polozky()->create([
                'vino_id' => $polozka['vino_id'],
                'pocet_lahvi' => $polozka['pocet'],
            ]);
        }

        session()->forget('kosik');

        return redirect('/nakupy/seznam')->with('success', 'Objednávka byla úspěšně vytvořena!');
    }
}
