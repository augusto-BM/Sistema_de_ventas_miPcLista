<?php

namespace App\Livewire\Autenticacion;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Iniciar Sesion - MiPcLista')]

class PaginaLogin extends Component
{
    public $email, $password;

    public function save(){
        /* dd($this->email, $this->password); */
        $this->validate([
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:6|max:255'
        ]);

        if (!auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('error', 'Las credenciales no coinciden con nuestros registros.');
            return;
        }

        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.autenticacion.pagina-login');
    }
}
