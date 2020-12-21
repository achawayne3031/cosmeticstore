<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
////use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;
use App\Payment;
use App\Ordered;
use DB;
use App\User;
use App\UserDetail;
use Auth;
use App\Products;
use App\userFund;
use App\UserTrans;
use Illuminate\Support\Facades\Http;


class PlaceOrder extends Controller
{
    //

    public function transit(Request $request){

        if(!Auth::user()){
            return view('auth.login');
        }

        $userName = substr(Auth::user()->name, 0, 4);
        $userRand = mt_rand();
        $userRand = substr($userRand, 0, 7);
        $user_id = $userName.$userRand;
        $user = User::find(Auth::user()->id);
        if($user->userID == '' || $user->userID == null){
            User::where('id', Auth::user()->id)->update(array('userID' => $user_id));
        }

        $sessionCart = $request->session()->get('cart');
        $userFun = userFund::where('email', Auth::user()->email)->get();
        if($userFun->first()){ 
            $currentBalance = $userFun[0]->amount;
        }else{
            $currentBalance = 0;
        }
        
        foreach($sessionCart as $item => $value){
            $stock = $value['stock'];
            $quantity = $value['quantity'];
            $name = $value['name'];
        }   

        if($stock < $quantity){
            return view('pages.cart')->with(['cart_alert' => 'Item with the name '. $name . ' has a limited supply, make the quantity to be less than ' . $stock]);
        }else{
            return view('pages.transit')->with(['balance' => $currentBalance]);
        }

    }

    public function pay(Request $request){
                    
            //check if request was made with the right data
            /*
            if(!$_SERVER['REQUEST_METHOD'] == 'POST' || !isset($_POST['reference'])){

                die("Transaction reference not found");
            }
            */

            if(!$request->isMethod('post') || !isset($request->reference)){
                die("Transaction reference not found");
            }
            //set reference to a variable @reference
           // $reference = $_POST['reference'];
           $reference = $request->input('reference');

            //The parameter after verify/ is the transaction reference to be verified
            $url = 'https://api.paystack.co/transaction/verify/'.$reference;
            //open connection
            $ch = curl_init();
            //set request parameters 
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer sk_test_a4011fd94dc8035d2844fccc790c8c455c8b3035']);


            //send request
            $request = curl_exec($ch);
            //close connection
            curl_close($ch);
            //declare an array that will contain the result
            $result = array();


            if($request){
            $result = json_decode($request, true);
            }

            if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {

            echo "success";
            //Perform necessary action
            }else{

            echo "Transaction was unsuccessful";
            }


    }




    public function saveOrderFromAccount(Request $request){

        $this->validate($request, [
            'id' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'delMethod' => 'required',
            'state' => 'required',
            'local' => 'required',
            'payment' => 'required',
            'date' => 'required',
            'balance' => 'required'
            
        ]);


        ////////////// Generate user payment ref//////////////
        $userName = substr(Auth::user()->name, 0, 4);
        $userRand = mt_rand();
        $userRand = substr($userRand, 0, 9);
        $user_ref = $userName.$userRand;
                   
       $user = User::find(Auth::user()->id);

       if($user->phone == '' || $user->phone == null){
            User::where('id', Auth::user()->id)->update(array('phone' => $request->phone));
            User::where('id', Auth::user()->id)->update(array('state' => $request->state));
            User::where('id', Auth::user()->id)->update(array('local' => $request->local));
       }
            
       $sessionCart = $request->session()->get('cart');

         /////////////// Save the transaction //////////////
         $userTrans = new UserTrans;
         $userTrans->email = Auth::user()->email;
         $userTrans->userID = Auth::user()->userID;
         $userTrans->amount = $request->payment;
         $userTrans->desc = "Order Payment";
         $userTrans->status = "paid";
         $userTrans->ref = $user_ref;
         $userTrans->date_of_payment = $request->date;
         $userTrans->save();

       ///////////// Update the users balance ////////////////
       UserFund::where('email', $request->email)->update(array('amount' => $request->balance));        

       



       foreach($sessionCart as $item => $value){
            $ordered = new Ordered;
            $product = new Products;

        
             ///////// update Available Stock/////////
            $current_id = $value['id'];
            $stock = Products::find($value['id']);
            $stock = $stock->stock;
            $current_stock = intval($stock) - intval($value['quantity']);
            Products::where('id', $current_id)->update(array('stock' => $current_stock));

            ////////// Update Sold Products///////
            $current_sold_id = $value['id'];
            $sold = Products::find($current_sold_id);
            $sold = $sold->sold;
            $current_sold = intval($sold) + intVal($value['quantity']);
            Products::where('id', $current_sold_id)->update(array('sold' => $current_sold));

                    
            ///////////// Add data to ordered tabel///////////
            $data[] = array(
            $ordered->pro_id = $value['id'],
            $ordered->name = $value['name'],
            $ordered->email = $request->input('email'),
            $ordered->payment_ref = $user_ref,
            $ordered->quantity = $value['quantity'],
            $ordered->price = $value['price'],
            $ordered->image = $value['image'],
            $ordered->delivery_method = $request->input('delMethod'),
            );
          $ordered->save();


       }           
      
        $payment = new Payment;
        $payment->name = Auth::user()->name;
        $payment->email = $request->input('email');
        $payment->phone = $request->input('phone');
        $payment->total_payment = $request->input('payment');
        $payment->ref = $user_ref;
        $payment->state = $request->input('state');
        $payment->local = $request->input('local');
        $payment->delivery_method = $request->input('delMethod');
        $payment->date_of_payment = $request->input('date');
        $payment->save();
        
        $request->session()->forget('cart');

        return "done";
            
        
    }




    public function saveOrder(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'delMethod' => 'required',
            'state' => 'required',
            'local' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'ref' => 'required'
            
        ]);

            
       $user = User::find(Auth::user()->id);

       if($user->phone == ''){
            User::where('id', Auth::user()->id)->update(array('phone' => $request->phone));
            User::where('id', Auth::user()->id)->update(array('state' => $request->state));
            User::where('id', Auth::user()->id)->update(array('local' => $request->local));
       }
            
       $sessionCart = $request->session()->get('cart');
       
       foreach($sessionCart as $item => $value){
            $ordered = new Ordered;
            $product = new Products;
            
            ///////// update Available Stock/////////
            $current_id = $value['id'];
            $stock = Products::find($value['id']);
            $stock = $stock->stock;
            $current_stock = intval($stock) - intval($value['quantity']);
            Products::where('id', $current_id)->update(array('stock' => $current_stock));
            
            ////////// Update Sold Products///////
            $current_sold_id = $value['id'];
            $sold = Products::find($current_sold_id);
            $sold = $sold->sold;
            $current_sold = intval($sold) + intVal($value['quantity']);
            Products::where('id', $current_sold_id)->update(array('sold' => $current_sold));
    
               
            
            ///////////// Add data to ordered tabel///////////
            $data[] = array(
            $ordered->pro_id = $value['id'],
            $ordered->email = $request->input('email'),
            $ordered->payment_ref = $request->input('ref'),
            $ordered->quantity = $value['quantity'],
            $ordered->price = $value['price'],
            $ordered->name = $value['name'],
            $ordered->image = $value['image'],
            $ordered->delivery_method = $request->input('delMethod')
            );

            $ordered->save();

       }     
       
       ///////// cloudinary 
       ///////// bmunzcvl
       ///// image upload https://api.cloudinary.com/v1_1/dqob23x5p/image/upload
       ////// preset bmunzcvl/image/upload
      
        $payment = new Payment;
        $payment->name = $request->input('name');
        $payment->email = $request->input('email');
        $payment->phone = $request->input('phone');
        $payment->total_payment = $request->input('amount');
        $payment->ref = $request->input('ref');
        $payment->state = $request->input('state');
        $payment->local = $request->input('local');
        $payment->delivery_method = $request->input('delMethod');
        $payment->date_of_payment = $request->input('date');
        $payment->save();
        
        $request->session()->forget('cart');

        return "done";
            


    }



    public function getState(){
        /*
        $data = Storage::get('public/images/raw.json');
        $json = json_decode($data, true);
        $output = [];
        foreach ($json as $key => $value) {
            if (!is_array($value)) {
                $key . '=>' . $value . '<br/>';
            } else {
                foreach ($value as $key => $val) {
                    $output[] .= $val["name"];
                }
            }
        }
        return json_encode($output);
        */
        $response = Http::get('http://locationsng-api.herokuapp.com/api/v1/states');
        return $response;

    }

    public function getLocal(){
        /*
        $state = $request->input('state');
        $data = Storage::get('public/images/raw.json');
        $json = json_decode($data, true);
            $output = [];
        foreach ($json as $key => $value) {
            if (!is_array($value)) {
                 $key . '=>' . $value . '<br/>';
            } else {
                foreach ($value as $key => $val) {
                    if($val["name"] == $state){
                        foreach($val["locals"] as $key => $value){
                            $output[] .= $value["name"];
                        
                        }
                    }
            
                }
            }
        }

        return json_encode($output);

        */

        $response = Http::get('http://locationsng-api.herokuapp.com/api/v1/lgas');
        return $response;
       

    }

   // 20 73 74 61 77
}
