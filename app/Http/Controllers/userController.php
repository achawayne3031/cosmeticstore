<?php

namespace App\Http\Controllers;
use App\UserDetail;
use Auth;
use App\Ordered;
use App\User;
use App\userFund;
use App\UserTrans;
use App\Payment;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class userController extends Controller
{
    //

    public function __construct(){
        
            /*
            $userName = substr(Auth::user()->name, 0, 4);
            $userRand = mt_rand();
            $userRand = substr($userRand, 0, 7);
            $user_id = $userName.$userRand;
            $user = User::find(Auth::user()->id);
            if($user->userID == '' || $user->userID == null){
                User::where('id', Auth::user()->id)->update(array('userID' => $user_id));
            }
            */
        
    }

    public function dashboard(){

        $userName = substr(Auth::user()->name, 0, 4);
        $userRand = mt_rand();
        $userRand = substr($userRand, 0, 7);
        $user_id = $userName.$userRand;
        $user = User::find(Auth::user()->id);
        if($user->userID == '' || $user->userID == null){
            User::where('id', Auth::user()->id)->update(array('userID' => $user_id));
        }
        

        $email = Auth::user()->email; 
        $orders = Ordered::where('email', $email)->get();
        $fund = userFund::where('email', $email)->get();
      //  return $orders;
        return view('user.user-dashboard')->with(['orders' => $orders, 'fund' => $fund]);
    }

    public function userFundAccount(Request $request){
        $userFun = userFund::where('email', $request->email)->get();
        $userRand = mt_rand();
        $userRand = substr($userRand, 0, 9);

        if(!$userFun->first()){ 
            $userFund = new userFund;
            $userFund->email = $request->email;
            $userFund->amount = $request->amount;
            $userFund->userID = $request->id;
            $userFund->status = 'approved';
            $userFund->date_of_funding = $request->myDate;
            $userFund->save();

            $userTrans = new userTrans;
            $userTrans->userID = $request->id;
            $userTrans->email = $request->email;
            $userTrans->amount = $request->amount;
            $userTrans->desc = 'user payment';
            $userTrans->status = 'paid';
            $userTrans->ref = $request->ref;
            $userTrans->date_of_payment = $request->myDate;
            $userTrans->save();

            return "success";
        }else{

            $userTrans = new userTrans;
            $userTrans->userID = $request->id;
            $userTrans->email = $request->email;
            $userTrans->amount = $request->amount;
            $userTrans->desc = 'user payment';
            $userTrans->status = 'paid';
            $userTrans->ref = $request->ref;
            $userTrans->date_of_payment = $request->myDate;
            $userTrans->save();

            $currentAmount = intval($userFun[0]->amount);
            $newAmount = $request->amount + $currentAmount;
            UserFund::where('email', $request->email)->update(array('amount' => $newAmount));        

            return "success";
            
        }

    }

    public function profile(){
        $email = Auth::user()->email;   
        $fund = userFund::where('email', $email)->get();
        $user = UserDetail::where('email', $email)->get();
        return view('user.user-profile')->with(['user' => $user, 'fund' => $fund]);
    }


    public function seeOrder($ref){
        $email = Auth::user()->email;   
        $fund = userFund::where('email', $email)->get();
        $order = Ordered::where('payment_ref', $ref)->get();
        return view('user.user-see-order')->with(['order' => $order, 'fund' => $fund]);
       // return $ref;
    }


    //////////// User Update password////////////
    public function updatePassword(Request $request){
        $email = Auth::user()->email;
        $password = Hash::make($request->password);

        $result = User::where('email', $email)->update(array('password' => $password));        

        if($result === 1){
            return "success";
        }else{
            return "failed";
        }
        
    }


    public function orders(){
        $email = Auth::user()->email;  
        $fund = userFund::where('email', $email)->get();
        $payment = Payment::where('email', $email)->orderBy('id', 'DESC')->paginate(7);
        return view('user.user-orders')->with(['payment' => $payment, 'fund' => $fund]);
    }

    public function fund(){

        $userName = substr(Auth::user()->name, 0, 4);
        $userRand = mt_rand();
        $userRand = substr($userRand, 0, 7);
        $user_id = $userName.$userRand;
        $user = User::find(Auth::user()->id);
        if($user->userID == '' || $user->userID == null){
            User::where('id', Auth::user()->id)->update(array('userID' => $user_id));
        }


        $email = Auth::user()->email;   
        $fund = userFund::where('email', $email)->get();
        $transDetail = UserTrans::where('email', Auth::user()->email)->orderBy('id', 'DESC')->paginate(10);
        if(!$transDetail->first()){ 
            return view('user.fund')->with(['trans' => 'no data entry', 'fund' => $fund]);
        }else{
            return view('user.fund')->with(['trans' => $transDetail, 'fund' => $fund]);
        }
    }


    public function showPasswordView(){
        return view('auth.reset-password');
    }

    public function checkEmailDB(Request $request){
       // return $request->email;
       // $email = User::find($request->email);
        $email = User::where('email', $request->email)->get();
        return $email;
    }

    public function changeUserPassword(Request $request){
        $email = $request->email;
        $password = Hash::make($request->password);

       return User::where('email', $request->email)->update(array('password' => $password));        

       // return "done";

    }

}
