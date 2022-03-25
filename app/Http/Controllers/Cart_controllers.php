<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Catalog;
session_start();

class Cart_controllers extends Controller
{
    public function Add_cart(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image_link' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_discount' => $data['cart_product_discount'],
                    
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image_link' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_discount' => $data['cart_product_discount'],
            );
            Session::put('cart', $cart);
        }
        Session::save();
    }
    public function View_cart()
    {
        $Ban_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Bàn')->get();
        $Ghe_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Ghế')->get();
        $Tu_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','Tủ')->get();
        $SOFA_catalog = Catalog::orderby('catalog_id', 'desc')->where('catalog_parent','SOFA')->get();
        return view('cart')->with(compact('Ban_catalog','Ghe_catalog','Tu_catalog','SOFA_catalog'));
    }
    public function Remove(Request $request)
    {
        $session_id = $request->id;
        $cart = Session::get('cart');
        if (isset($cart)) {
            foreach ($cart as $key => $item) {
                if ($item['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'Successfully!');
        } else {
            return redirect()->back()->with('error', 'Errors');
        }
    }
}
