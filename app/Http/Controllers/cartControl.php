<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class cartControl extends Controller
{


    public function add(Request $request, $id){
        $product = Products::find($id);
        if(!$product){
            abort(404);
        }
        $cart = $request->session()->get('cart');

        if(!$cart){
            if($product->discount_state ==  "on"){
                $test = $product->price / $product->discount;
                $price = $product->price - $test;
            }else{
                $price = $product->price;
            }
            $cart = [
                $id => [
                    'id' => $id,
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $price,
                    'image' => $product->images,
                    'stock' => $product->stock
                ]
             ];

                $request->session()->put('cart', $cart);
                return redirect('/item/'.$id)->with('success', 'Item Added, ');
        }

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
            $request->session()->put('cart', $cart);
            return redirect('/item/'.$id)->with('success', 'Item Added,');
        }else{
            if($product->discount_state ==  "on"){
                $test = $product->price / $product->discount;
                $price = $product->price - $test;
            }else{
                $price = $product->price;
            }
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'quantity' => 1,
                'price' => $price,
                'image' => $product->images,
                'stock' => $product->stock
            ];

            $request->session()->put('cart', $cart);
            return redirect('/item/'.$id)->with('success', 'Item Added,');
        }
    }


    public function view(Request $request){

      // return $request->session()->get('cart', 'id');
       return view('pages.cart');

    }

    public function update(Request $request){

        if($request->id && $request->quantity){

            $cart = $request->session()->get('cart');

            $cart[$request->id]['quantity'] = $request->quantity;
            $request->session()->put('cart', $cart);
           // $request->session()->flash('success', 'Item Updated');


            return redirect('/cart')->with('success', 'Item Updated');

        }
    }



    public function remove(Request $request){

        if($request->id){
            $cart = $request->session()->get('cart');
            if(isset($cart[$request->id])){
                unset($cart[$request->id]);
                $request->session()->put('cart', $cart);
            }
            return redirect('/cart')->with('success', 'Item Removed');

        }


    }


    public function ordered($msg){
        return view('pages.cart')->with(['msg' => 'Your item has been ordered']);
    }




}
