<?php

namespace App\Http\Controllers;

use App\Models\RadkyModel;
use App\Models\OsetreniModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlanovaniController extends Controller
{

    public function planovat()
    {
        $radky = RadkyModel::get();
        foreach ($radky as $r) {
            $r->druh_text = self::ODRUDA_TYP[$r->odruda_enum] ?? 'Neznámý druh';
        }

        return view('planovat', [
            'radky' => $radky,
            'akce_typy' => self::PLANOVANA_AKCE_TYP,
        ]);
    }

    public function planovat_post(Request $request)
    {
        if ($request->zvolene == null) {
            return redirect()->back()->with('failure','Je potřeba zvolit alespoň jeden řádek.')
            ->withInput();
        }
        $datumOsetreni = Carbon::parse($request->datum);
        if ($datumOsetreni->lt(Carbon::now()) && !$datumOsetreni->isToday()) {
            return redirect()->back()->with('failure', 'Nelze plánovat činnosti na stará data.')
            ->withInput($request->except('datum'));
        }
        $limit = $datumOsetreni->copy()->subWeeks(2);
        // If harvest, check for spray treatments
        if ($request->typ == 5) {
            $postriky = OsetreniModel::get()
                ->where('typ_enum', 3)
                ->whereIn('radky_id', $request->zvolene); // if spray treatment
            foreach ($postriky as $p) {
                $target = $p->datum_provedeni != null ? $p->datum_provedeni : $p->datum;
                if (
                    Carbon::parse($target)->between($limit, $datumOsetreni)
                ) {
                    return redirect()->back()->with('failure', 'Nelze naplánovat sklizeň, protože na některých řádcích proběhl postřik v rozmezí 2 týdnů před plánovanou sklizní.')
                    ->withInput();
                }
            }
        }
        // If spray treatment, check for harvests and additional params
        if ($request->typ == 3) {
            $postriky = OsetreniModel::get()
                ->where('typ_enum', 5)
                ->whereIn('radky_id', $request->zvolene); // if harvest
            foreach ($postriky as $p) {
                $target = $p->datum_provedeni != null ? $p->datum_provedeni : $p->datum;
                if (
                    Carbon::parse($target)->between($limit, $request->datum)
                ) {
                    return redirect()->back()->with('failure', 'Nelze naplánovat postřik, protože na některých řádcích proběhla sklizeň v rozmezí 2 týdnů před plánovaným postřikem.')
                    ->withInput();
                }
            }
            // Check that concentration and type is set
            if ($request->postrik == null || $request->koncentrace == null) {
                return redirect()->back()->with('failure', 'Pro plánování postřiku je nutno uvést název a koncentraci.')
                ->withInput();
            }
        }

        foreach ($request->zvolene as $id) {
            OsetreniModel::insert([
                'radky_id' => $id,
                'typ_enum' => $request->typ,
                'postrik_typ' => $request->postrik ?? null,
                'koncentrace' => $request->koncentrace ?? null,
                'poznamka' => $request->poznamka ?? null,
                'datum' => $request->datum,
            ]);
        }
        
        return redirect()->back()->with('success', 'Činnost byla úspěšně naplánována.');
    }

    public function list(Request $request) {
        $radky = OsetreniModel::with('radky')
            ->orderBy('datum', 'asc')
            ->get();
        foreach ($radky as $r) {
            $r->druh_text = self::ODRUDA_TYP[$r->radky->odruda_enum] ?? 'Neznámý druh';
            $r->typ_text = self::PLANOVANA_AKCE_TYP[$r->typ_enum] ?? 'Neznámé ošetření';
            if ($r->stav == false) {
                $datumOsetreni = Carbon::parse($r->datum);
                $r->stav_text = $datumOsetreni->gt(Carbon::now()) || $datumOsetreni->isToday() ? "Nevyřízeno" : "Nevyřízeno (Po termínu)"; 
            } else {
                $r->stav_text = $r-> datum < $r->datum_provedeni ? "Vyřízeno (Po termínu)" : "Vyřízeno";
            }
        }
        return view('cinnosti-list', ['radky' => $radky]);
    }
}
