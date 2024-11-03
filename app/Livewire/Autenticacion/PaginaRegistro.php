<?php

namespace App\Livewire\Autenticacion;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Crear Cuenta - MiPcLista')]

class PaginaRegistro extends Component
{
    public $name, $email, $password;

    public function save(){
        /* dd($this->name, $this->email, $this->password); */
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|max:255'
        ]);

        //Guardamos el usuario en la base de datos
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        //Iniciamos sesión
        auth()->login($user);

        //Redireccionamos a la página de inicio
        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.autenticacion.pagina-registro');
    }
}
