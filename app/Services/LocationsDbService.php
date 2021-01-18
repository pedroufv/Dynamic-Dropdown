<?php

namespace App\Services;

use App\Models\Estado;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class LocationsDbService implements LocationsServiceInterface
{
    public function getEstados(): Collection
    {
        if (! Cache::get('estados')) {
            Cache::put('estados', Estado::orderBy('nome')->get());
        }

        return Cache::get('estados');
    }

    public function getMunicipios(string $siglaEstado): Collection
    {
        if (! Cache::get('municipios_' . $siglaEstado)) {
            Cache::put('municipios_' . $siglaEstado, Estado::where('sigla', $siglaEstado)->first()->municipios);
        }

        return Cache::get('municipios_' . $siglaEstado);
    }
}
