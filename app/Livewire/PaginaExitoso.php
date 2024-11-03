<?php

namespace App\Livewire;

use App\Models\Pedido;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Title('Pago exitoso - MiPcLista')]
class PaginaExitoso extends Component
{
    #[Url]
    public $session_id;
    public function render()
    {
        //Obtener el último pedido realizado por el usuario
        $ultimo_pedido = Pedido::with('direccion')->where('user_id', auth()->user()->id)->latest()->first();

        if ($this->session_id) {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $session_info = Session::retrieve($this->session_id);
            /* dd($session_info); */
            if ($session_info->payment_status != 'paid') {
                $ultimo_pedido->estado_pago = 'Fallido';
                $ultimo_pedido->save();
                return redirect('/cancelacion');
            } else if ($session_info->payment_status == 'paid') {
                $ultimo_pedido->estado_pago = 'Pagado';
                $ultimo_pedido->save();
            }
        }

        return view('livewire.pagina-exitoso', [
            'pedido' => $ultimo_pedido,
        ]);
    }
}
