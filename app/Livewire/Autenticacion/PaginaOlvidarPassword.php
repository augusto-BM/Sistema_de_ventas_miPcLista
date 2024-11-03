<?php

namespace App\Livewire\Autenticacion;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

use Livewire\Attributes\Title;

#[Title('Olvidar Contraseña - MiPcLista')]

class PaginaOlvidarPassword extends Component
{
    public $email;

    public function save(){
        $this->validate([
            'email' => 'required|email|max:255|exists:users,email'
        ]);

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', 'Se ha enviado un enlace de restablecimiento de contraseña a su correo electrónico.');
            $this->email = '';
        } else {
            session()->flash('error', __($status));
        }
    }

    public function render()
    {
        return view('livewire.autenticacion.pagina-olvidar-password');
    }
}
