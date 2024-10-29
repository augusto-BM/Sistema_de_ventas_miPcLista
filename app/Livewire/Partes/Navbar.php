<?php

namespace App\Livewire\Partes;

use App\Ayudantes\GestionCarrito;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $cuenta_total = 0;

    //Para recibir la cuenta total del carrito funcion especial mount de livewire
    public function mount(){
        $this->cuenta_total = count(GestionCarrito::getCartItemsFromCookie());
    }

    #[On('editar-cuenta-carrito')]
    public function editarCuentaCarrito($cuenta_total){
        $this->cuenta_total = $cuenta_total;
    }

    public function render()
    {
        return view('livewire.partes.navbar');
    }
}
