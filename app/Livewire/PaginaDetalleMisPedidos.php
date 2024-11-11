<?php

namespace App\Livewire;

use App\Models\DetallePedido;
use App\Models\Direccion;
use App\Models\Pedido;
use Livewire\Attributes\Title;

use Livewire\Component;

#[Title('Detalle pedido - MiPcLista')]
class PaginaDetalleMisPedidos extends Component
{
    public $pedido_id;

    public function mount($pedido_id)
    {
        $this->pedido_id = $pedido_id;
        /* dd($this->pedido_id); */

    }

    public function render()
    {
        $detalle_pedidos = DetallePedido::with('producto')->where('pedido_id', $this->pedido_id)->get();
        $direcciones = Direccion::where('pedido_id', $this->pedido_id)->first();
        $pedido = Pedido::where('id', $this->pedido_id)->first();

        return view('livewire.pagina-detalle-mis-pedidos',[
            'detalle_pedidos' => $detalle_pedidos,
            'direcciones' => $direcciones,
            'pedido' => $pedido
        ]);
    }
}
