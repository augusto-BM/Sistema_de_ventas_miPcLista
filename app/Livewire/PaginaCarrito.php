<?php

namespace App\Livewire;

use App\Ayudantes\GestionCarrito;
use App\Livewire\Partes\Navbar;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Carrito - MiPcLista')]
class PaginaCarrito extends Component
{
    public $productos_carrito = [];
    public $cantidad_total;

    public function mount(){
        $this->productos_carrito = GestionCarrito::getCartItemsFromCookie();
        $this->cantidad_total = GestionCarrito::calculateGrandTotal($this->productos_carrito);
    }

    public function eliminarProducto($product_id){
        $this->productos_carrito = GestionCarrito::removeCartItem($product_id);
        $this->cantidad_total = GestionCarrito::calculateGrandTotal($this->productos_carrito);
        $this->dispatch('editar-cuenta-carrito', cuenta_total: count($this->productos_carrito))->to(Navbar::class);
    }

    public function incrementarCantidad($product_id){
        $this->productos_carrito = GestionCarrito::incrementQuantityToCartItem($product_id);
        $this->cantidad_total = GestionCarrito::calculateGrandTotal($this->productos_carrito);
    }

    public function decrementarCantidad($product_id){
        $this->productos_carrito = GestionCarrito::decrementQuantityToCartItem($product_id);
        $this->cantidad_total = GestionCarrito::calculateGrandTotal($this->productos_carrito);
    }
    

    public function render()
    {
        return view('livewire.pagina-carrito');
    }
}
