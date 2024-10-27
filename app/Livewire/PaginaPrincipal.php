<?php

namespace App\Livewire;

use App\Models\Marca;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Categoria;

#[Title('Página Principal - MiPcLista')]
class PaginaPrincipal extends Component
{
    public function render()
    {
        // Obtenemos las marcas que están activas
        $marcas = Marca::where('es_activo', 1)->get();
        //dd($marcas);  //Verifica que se estén obteniendo las marcas

        $categorias = Categoria::where('es_activo', 1)->get();


        /* return view('livewire.pagina-principal'); */
        return view('livewire.pagina-principal', [
            'marcas' => $marcas ,
            'categorias' => $categorias
        ]);
    }
}
