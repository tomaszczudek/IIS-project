<?php

namespace App\Http\Controllers;


abstract class Controller
{
    const PLANOVANA_AKCE_TYP = [
        1 => 'Řezání',
        2 => 'Hnojení',
        3 => 'Postřik',
        4 => 'Zavlažování',
        5 => 'Sklizeň',
    ];
    const ODRUDA_TYP = [
        0 => 'Prázdný lánek',
        1 => 'Ryzlink rýnský',
        2 => 'Rulandské šedé',
        3 => 'Veltlínské zelené',
        4 => 'Müller Thurgau',
        5 => 'Svatovavřinecké',
        6 => 'Rulandské modré',
        7 => 'Zweigeltrebe',
    ];

    const STAV_TYP = [
        0 => 'Nezpracováno',
        1 => 'Zpracováno',
        2 => 'Odesláno',
        3 => 'Doručeno',
        4 => 'Zrušeno',
    ];
}
