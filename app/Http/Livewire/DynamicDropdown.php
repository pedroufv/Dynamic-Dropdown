<?php

namespace App\Http\Livewire;

use App\Facades\Locations;
use Livewire\Component;

class DynamicDropdown extends Component
{
    public $estado;
    public $municipios = [];

    public function getEstadosProperty()
    {
        return Locations::getEstados();
    }

    public function updatedEstado()
    {
        $this->municipios = Locations::getMunicipios($this->estado);
    }

    public function render()
    {
        return view('livewire.dynamic-dropdown');
    }
}
