<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class LocationsApiService implements LocationsServiceInterface
{
    public function getEstados(): Collection
    {
        if (! Cache::get('estados')) {
            Cache::put('estados', collect(Http::get(
                'https://servicodados.ibge.gov.br/api/v1/localidades/estados',
                ['orderBy' => 'nome']
            )->object()));
        }

        return Cache::get('estados');
    }

    public function getMunicipios(string $siglaEstado): Collection
    {
        if (! Cache::get('municipios_' . $siglaEstado)) {
            Cache::put('municipios_' . $siglaEstado, collect(Http::get(
                "https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$siglaEstado}/municipios"
            )->object()));
        }

        return Cache::get('municipios_' . $siglaEstado);
    }
}
