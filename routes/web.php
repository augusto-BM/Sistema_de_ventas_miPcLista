<?php

use App\Livewire\Autenticacion\PaginaLogin;
use App\Livewire\Autenticacion\PaginaOlvidarPassword;
use App\Livewire\Autenticacion\PaginaRegistro;
use App\Livewire\Autenticacion\PaginaRestablecerPassword;
use App\Livewire\PaginaCancelacion;
use App\Livewire\PaginaCarrito;
use App\Livewire\PaginaCategorias;
use App\Livewire\PaginaDetalleMisPedidos;
use App\Livewire\PaginaDetalleProducto;
use App\Livewire\PaginaExitoso;
use App\Livewire\PaginaMisPedidos;
use App\Livewire\PaginaPago;
use App\Livewire\PaginaPrincipal;
use App\Livewire\PaginaProductos;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', PaginaPrincipal::class);

Route::get('/categorias', PaginaCategorias::class);
Route::get('/productos', PaginaProductos::class);
Route::get('/carrito', PaginaCarrito::class);
Route::get('/productos/{identificador_url}', PaginaDetalleProducto::class);




Route::middleware('guest')->group(function () {
    Route::get('/login', PaginaLogin::class)->name('login');
    Route::get('/registrar', PaginaRegistro::class);
    Route::get('/olvidar', PaginaOlvidarPassword::class)->name('password.request');
    Route::get('/restablecer/{token}', PaginaRestablecerPassword::class)->name('password.reset');

});


Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->to('/');
    });
    Route::get('/pago', PaginaPago::class);
    Route::get('/mis-pedidos', PaginaMisPedidos::class);
    Route::get('/mis-pedidos/{pedido}', PaginaDetalleMisPedidos::class)->name('mi-pedido.mostrar');
    Route::get('/exitoso', PaginaExitoso::class)->name('exitoso');
    Route::get('/cancelacion', PaginaCancelacion::class)->name('cancelacion');
});
