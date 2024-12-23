<?php

namespace App\Livewire;

use App\Ayudantes\GestionCarrito;
use App\Livewire\Partes\Navbar;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Productos - MiPcLista')]
class PaginaProductos extends Component
{
    //Para mostrar alertas de sweetalert en livewire
    use LivewireAlert;

    //Para tener paginacion de los productos
    use WithPagination;



    //Para filtrar por categorias
    #[Url]
    public $categorias_seleccionadas = [];

    //Para filtrar por marcas
    #[Url]
    public $marcas_seleccionadas = [];

    //Para filtrar por destacados
    #[Url]
    public $destacado;

    //Para filtrar en ofertas
    #[Url]
    public $en_oferta;

    //Para filtrar por rangos de precios
    #[Url]
    public $precio_rango = 10000;

    //Para Ordenar por último
    #[Url]
    public $ordenar = 'el_ultimo';

    //Añadir un producto al carrito
    public function agregarAlCarrito($producto_id)
    {
        /* dd($producto_id); */
        $cuenta_total = GestionCarrito::addItemToCart($producto_id);
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
        $productoQuery = Producto::query()->where('es_activo', 1);

        //Filtramos por categorias
        if (!empty($this->categorias_seleccionadas)) {
            $productoQuery->whereIn('category_id', $this->categorias_seleccionadas);
        }

        //Filtramos por marcas
        if (!empty($this->marcas_seleccionadas)) {
            $productoQuery->whereIn('marcas_id', $this->marcas_seleccionadas);
        }

        //Filtramos por destacados
        if ($this->destacado) {
            $productoQuery->where('es_destacado', 1);
        }

        //Filtramos en oferta
        if ($this->en_oferta) {
            $productoQuery->where('en_oferta', 1);
        }

        //Filtramos por rango de precios
        $productoQuery->whereBetween('precio', [0, $this->precio_rango]);

        //Ordenamos por el ultimo 
        if ($this->ordenar == 'el_ultimo') {
            $productoQuery->latest();
        }
        if ($this->ordenar == 'el_precio') {
            $productoQuery->orderBy('precio');
        }

        return view('livewire.pagina-productos', [
            'productos' => $productoQuery->paginate(6),
            'marcas' => Marca::where('es_activo', 1)->get(['id', 'nombre', 'identificador_url']),
            'categorias' => Categoria::where('es_activo', 1)->get(['id', 'nombre', 'identificador_url']),

        ]);
    }
}
