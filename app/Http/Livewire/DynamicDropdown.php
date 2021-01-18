<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DynamicDropdown extends Component
{
    public $estado;
    public $municipios = [];

    public function getEstadosProperty()
    {
        if (! Cache::get('estados')) {
             Cache::put('estados', Http::get(
                 'https://servicodados.ibge.gov.br/api/v1/localidades/estados',
                 ['orderBy' => 'nome']
             )->object());
        }

        return Cache::get('estados');
    }

    public function updatedEstado()
    {
        $this->municipios = Http::get(
            "https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$this->estado}/municipios"
        )->object();
    }

    public function render()
    {
        return view('livewire.dynamic-dropdown');
    }
}
