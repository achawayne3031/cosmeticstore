<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use Auth;
use App\User;
use App\Newsletter;

class ProductsController extends Controller
{
    //

    public function index()
    {
        $total_pro = Products::all();
        $most_order = Products::max('sold');
        //////////// Most ordered/sold alogrthrim///////
        $sold = [];
        $most_order_output = [];
        $currentView = null;
        foreach($total_pro as $value){
            array_push($sold, $value->sold);
        }
        rsort($sold);
        for($x = 0; $x < count($sold); $x++) {
            $currentView = Products::where('sold', $sold[$x])->get();
            $currentView = $currentView[0];
            
            array_push($most_order_output, $currentView);
        }
        $products = Products::orderBy('created_at', 'DESC')->take(4)->get();
        return view('index')->with(['products'=> $products, 'sales' => $most_order_output]);
    }


    public function contact(){
        return view('contact');
    }

    public function shop(){
        return view('pages.shop');
    }


    public function newsletter(Request $request){

        $news = Newsletter::where('email', $request->email)->get();

        if(!$news->first()){ 
            if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
               return $emailErr = "invalid";
              }
              $sub = new Newsletter;
              $sub->email = $request->email;
              $sub->save();
            return "success";
        }else{
            return "registered";
        }

       // $newsletter = new Newsletter;
    }


}
