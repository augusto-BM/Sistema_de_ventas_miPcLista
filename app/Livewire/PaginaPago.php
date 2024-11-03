<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Ayudantes\GestionCarrito;
use App\Models\Direccion;
use App\Models\Pedido;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Title('Pagar - MiPcLista')]
class PaginaPago extends Component
{
    public $nombres, $apellidos, $telefono, $direccion, $ciudad, $estado, $codigo_postal, $metodo_pago;

    // validar que no se pueda acceder a la página de pago si no hay productos en el carrito
    public function mount(){
        $productos_carrito = GestionCarrito::getCartItemsFromCookie();
        if(count($productos_carrito) == 0){
            return redirect('/productos');
        }
    }

    public function lugarPedido()
    {
        $this->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'estado' => 'required',
            'codigo_postal' => 'required',
            'metodo_pago' => 'required'
        ]);

        $productos_carrito = GestionCarrito::getCartItemsFromCookie();
        $linea_productos = [];

        foreach ($productos_carrito as $producto) {
            $linea_productos[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $producto['unit_amount'] * 100, // Convertir a centavos
                    'product_data' => [
                        'name' => $producto['name'],
                    ]
                ],
                'quantity' => $producto['quantity'],
            ];
        }

        $pedido = new Pedido();
        $pedido->user_id = auth()->user()->id;
        $pedido->total_pagar = GestionCarrito::calculateGrandTotal($productos_carrito);
        $pedido->metodo_pago = $this->metodo_pago;
        $pedido->estado_pago = 'pendiente';
        $pedido->estado = 'nuevo';
        $pedido->moneda = 'PEN';
        $pedido->monto_envio = 0;
        $pedido->metodo_envio = 'ninguna';
        $pedido->notas = 'Pedido realizado por ' . auth()->user()->name;

        $pedido->save(); // Guardar el pedido primero para obtener el ID

        // Guardar la dirección
        $direccion = new Direccion();
        $direccion->nombre = $this->nombres;
        $direccion->apellido = $this->apellidos;
        $direccion->celular = $this->telefono;
        $direccion->direccion = $this->direccion;
        $direccion->ciudad = $this->ciudad;
        $direccion->estado = $this->estado;
        $direccion->codigo_postal = $this->codigo_postal;
        $direccion->pedido_id = $pedido->id; // Relacionar dirección con el pedido
        $direccion->save();

        // Preparar la redirección
        $redireccionamiento_url = '';
        if ($this->metodo_pago == 'stripe') {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $sessionPagar = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => auth()->user()->email,
                'line_items' => $linea_productos,
                'mode' => 'payment',
                'success_url' => route('exitoso') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cancelacion'),
            ]);

            $redireccionamiento_url = $sessionPagar->url;
        } else {
            $redireccionamiento_url = route('exitoso'); // Pago contra entrega
        }

        // Guardar los detalles del pedido
        $detallePedidos = [];
        foreach ($productos_carrito as $producto) {
            $detallePedidos[] = [
                'pedido_id' => $pedido->id, // Relacionar detalle con el pedido
                'producto_id' => $producto['product_id'],
                'cantidad' => $producto['quantity'],
                'monto_unitario' => $producto['unit_amount'],
                'monto_total' => $producto['total_amount'],
            ];
        }

        $pedido->detallePedidos()->createMany($detallePedidos); // Insertar detalles del pedido

        GestionCarrito::clearCartItemsFromCookie(); // Limpiar el carrito
        return redirect($redireccionamiento_url);
    }

    public function render()
    {
        $productos_carrito = GestionCarrito::getCartItemsFromCookie();
        $cantidad_total = GestionCarrito::calculateGrandTotal($productos_carrito);
        return view('livewire.pagina-pago', [
            'productos_carrito' => $productos_carrito,
            'cantidad_total' => $cantidad_total
        ]);
    }
}
