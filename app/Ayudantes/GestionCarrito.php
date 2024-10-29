<?php

namespace App\Ayudantes;

use App\Models\Producto;
use Illuminate\Support\Facades\Cookie;

class GestionCarrito
{
  //Añadir un producto al carrito con cookies
  static public function addItemToCart($product_id)
  {
    $cart_items = self::getCartItemsFromCookie();

    $existing_item = null;

    foreach ($cart_items as $key => $item) {
      if ($item['product_id'] == $product_id) {
        $existing_item = $key;
        break;
      }
    }

    if ($existing_item !== null) {
      $cart_items[$existing_item]['quantity']++;
      $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
    } else {
      $producto = Producto::where('id', $product_id)->first(['id', 'nombre', 'precio', 'imagen']);
      if ($producto) {
        $cart_items[] = [
          'product_id' => $product_id,
          'name' => $producto->nombre,
          'image' => $producto->imagen[0],
          'quantity' => 1,
          'unit_amount' => $producto->precio,
          'total_amount' => $producto->precio

        ];
      }
    }

    self::addCartItemsToCookie($cart_items);
    return count($cart_items);
  }

  //Añadir un producto desde detalle producto con cookies con sus cantidades respectivas
  static public function addItemToCartWithQty($product_id, $qty = 1)
  {
    $cart_items = self::getCartItemsFromCookie();

    $existing_item = null;

    foreach ($cart_items as $key => $item) {
      if ($item['product_id'] == $product_id) {
        $existing_item = $key;
        break;
      }
    }

    if ($existing_item !== null) {
      $cart_items[$existing_item]['quantity'] = $qty;
      $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
    } else {
      $producto = Producto::where('id', $product_id)->first(['id', 'nombre', 'precio', 'imagen']);
      if ($producto) {
        $cart_items[] = [
          'product_id' => $product_id,
          'name' => $producto->nombre,
          'image' => $producto->imagen[0],
          'quantity' => $qty,
          'unit_amount' => $producto->precio,
          'total_amount' => $producto->precio

        ];
      }
    }

    self::addCartItemsToCookie($cart_items);
    return count($cart_items);
  }

  //Eliminar un producto del carrito
  static public function removeCartItem($product_id)
  {
    $cart_items = self::getCartItemsFromCookie();

    foreach ($cart_items as $key => $item) {
      if ($item['product_id'] == $product_id) {
        unset($cart_items[$key]);
      }
    }

    self::addCartItemsToCookie($cart_items);
    return $cart_items;
  }

  //Añadir productos al carrito con cookies
  static public function addCartItemsToCookie($cart_items)
  {
    Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30); //30 días de duración de la cookie
  }

  //Limpiar productos del carrito de las cookies
  static public function clearCartItemsFromCookie()
  {
    Cookie::queue(Cookie::forget('cart_items'));
  }
  /* aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa ?? [] */
  //Obtener todos los productos del carrito de las cookies
  static public function getCartItemsFromCookie()
  {
    $cart_items = json_decode(Cookie::get('cart_items', true), true);

    //Si no hay productos en el carrito, devolvemos un array vacío
    if (!is_array($cart_items)) {
      $cart_items = [];
    }
    return  $cart_items;
  }

  //Incrementar la cantidad de un producto en el carrito
  static public function incrementQuantityToCartItem($product_id)
  {
    $cart_items = self::getCartItemsFromCookie();

    foreach ($cart_items as $key => $item) {
      if ($item['product_id'] == $product_id) {
        $cart_items[$key]['quantity']++;
        $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
      }
    }

    self::addCartItemsToCookie($cart_items);
    return $cart_items;
  }

  //Decrementar la cantidad de un producto en el carrito
  static public function decrementQuantityToCartItem($product_id)
  {
    $cart_items = self::getCartItemsFromCookie();

    foreach ($cart_items as $key => $item) {
      if ($item['product_id'] == $product_id) {
        if ($cart_items[$key]['quantity'] > 1) {
          $cart_items[$key]['quantity']--;
          $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
        }
      }
    }

    self::addCartItemsToCookie($cart_items);
    return $cart_items;
  }

  //Calcular el total de los productos en el carrito
  static public function calculateGrandTotal($items)
  {
    return array_sum(array_column($items, 'total_amount'));
  }
}
