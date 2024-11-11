<?php

namespace App\Livewire;

use App\Models\Pedido;
use Livewire\Attributes\Title;

use Livewire\Component;
use Livewire\WithPagination;

#[Title('Mis pedidos - MiPcLista')]

class PaginaMisPedidos extends Component
{
    use WithPagination;

    public function render()
    {
        $mis_pedidos = Pedido::where('user_id', auth()->id())->latest()->paginate(5);
        return view('livewire.pagina-mis-pedidos',[
            'mis_pedidos' => $mis_pedidos
        ]);
    }
}
