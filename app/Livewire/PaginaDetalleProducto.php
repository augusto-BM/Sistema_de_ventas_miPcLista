<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Detalle Producto - MiPcLista')]
class PaginaDetalleProducto extends Component
{
    //Para recibir el identificador de la url del producto
    public $identificador_url;
    public function mount($identificador_url)
    {
        $this->identificador_url = $identificador_url;
    }

    public function render()
    {
        return view('livewire.pagina-detalle-producto', [
            'producto' => Producto::where('identificador_url', $this->identificador_url)->firstOrFail()
        ]);
    }
}
