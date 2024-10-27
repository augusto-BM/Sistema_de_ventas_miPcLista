<?php

namespace App\Livewire;

use App\Models\Categoria;
use Livewire\Attributes\Title;

use Livewire\Component;

#[Title('Categorias - MiPcLista')]
class PaginaCategorias extends Component
{
    public function render()
    {
        $categorias = Categoria::where('es_activo', 1)->get();

        return view('livewire.pagina-categorias', [
            'categorias' => $categorias
        ]);
    }
}
