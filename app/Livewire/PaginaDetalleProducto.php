<?php

namespace App\Livewire;

use App\Ayudantes\GestionCarrito;
use App\Livewire\Partes\Navbar;
use App\Models\Producto;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Detalle Producto - MiPcLista')]
class PaginaDetalleProducto extends Component
{
    //Para mostrar alertas de sweetalert en livewire
    use LivewireAlert;
    
    //Para recibir el identificador de la url del producto
    public $identificador_url;

    public $cantidad = 1; //Cantidad de productos a añadir al carrito

    //Para recibir el identificador de la url del producto funcion especial mount de livewire 
    public function mount($identificador_url)
    {
        $this->identificador_url = $identificador_url;
    }

    public function incrementarCantidad()
    {
        $this->cantidad++;
    }

    public function decrementarCantidad()
    {
        if ($this->cantidad > 1) {
            $this->cantidad--;
        }
    }

    //Añadir un producto al carrito
    public function agregarAlCarrito($producto_id)
    {
        $cuenta_total = GestionCarrito::addItemToCartWithQty($producto_id, $this->cantidad);
        $this->dispatch('editar-cuenta-carrito', cuenta_total: $cuenta_total)->to(Navbar::class);

        $this->alert('success', 'Producto añadido al carrito', [
            'position' =>  'bottom-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'El producto se añadió correctamente al carrito',
            'showCancelButton' => false,
            'showConfirmButton' => false
        ]);
    }

    public function render()
    {
        return view('livewire.pagina-detalle-producto', [
            'producto' => Producto::where('identificador_url', $this->identificador_url)->firstOrFail()
        ]);
    }
}
