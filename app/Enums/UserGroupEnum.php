<?php

namespace App\Enums;

enum UserGroupEnum: string
{
    case ADMIN = 'admin';
    case CUSTOMER = 'customer';
    case WORKER = 'worker';
    case WINEMAKER = 'winemaker';

    public function name() {
        return match($this) {
            UserGroupEnum::ADMIN => 'Administrátor',
            UserGroupEnum::CUSTOMER => 'Zákazník',
            UserGroupEnum::WORKER => 'Pracovník',
            UserGroupEnum::WINEMAKER =>  'Vinař'
        };
    }
}
