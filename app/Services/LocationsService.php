<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class LocationsService
{
    public function getEstados(): array
    {
        if (! Cache::get('estados')) {
            Cache::put('estados', Http::get(
                'https://servicodados.ibge.gov.br/api/v1/localidades/estados',
                ['orderBy' => 'nome']
            )->object());
        }

        return Cache::get('estados');
    }

    public function getMunicipios(string $singlaEstado): array
    {
        if (! Cache::get('municipios_' . $singlaEstado)) {
            Cache::put('municipios_' . $singlaEstado, Http::get(
                "https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$singlaEstado}/municipios"
            )->object());
        }

        return Cache::get('municipios_' . $singlaEstado);
    }
}
