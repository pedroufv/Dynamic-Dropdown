<?php

namespace Database\Seeders;

use App\Models\Estado;
use App\Models\Municipio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = Http::get(
            'https://servicodados.ibge.gov.br/api/v1/localidades/estados',
            ['orderBy' => 'nome']
        )->object();

        foreach ($estados as $estado) {
            $estado = Estado::updateOrCreate(['codigo' => $estado->id], [
                'sigla' => $estado->sigla,
                'nome' => $estado->nome,
            ]);

            $this->runMunicipios($estado);
        }
    }

    private function runMunicipios(Estado $estado)
    {
        $municipios = Http::get(
            "https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$estado->sigla}/municipios"
        )->object();

        foreach ($municipios as $municipio) {
            Municipio::updateOrCreate(['codigo' => $municipio->id], [
                'nome' => $municipio->nome,
                'estado_id' => $estado->id,
            ]);
        }
    }
}
