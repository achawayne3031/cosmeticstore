<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\User;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Payment;
use App\Ordered;
use App\userTransaction;
use App\userFund;
use App\UserTrans;
use DB;
use App\Manager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;




class AdminController extends Controller
{



     //////////////// Create new Manager /////////////
     protected function createManager(Request $request)
     {

        /*
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

         $Manager = Manager::create([
             'email' => $request['email'],
             'password' => Hash::make($request['password']),
         ]);
         return redirect()->intended('/admin/dashboard');
         */
        $this->validator($request->all())->validate();
        $manger = Manager::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/admin');
         
     }
     

     //////////////// Handle the managers register view form////////////////
     public function showManagerRegisterForm()
     {
         return view('auth.register', ['url' => 'admin']);
     }


    ////////// Show admin login form/////////////
    public function showManagerLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    
    /////////// Post admin login details//////////////////
    public function managerLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('admin/dashboard');
          // return redirect('/admin/dashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }


    ///////// Get all the registered Users/////////////////
    public function regUsers(){
        $users = User::all();
        return view('admin.reg-user')->with('users', $users);
    }

    //////////// Delete user ///////////////////////////
    public function delUsers(Request $request){
        $user = User::find($request->id);
        $user->delete();
        return response()->json(['success'=>'Ajax request submitted']);
    }


    //////////// Get all sales details///////////////////
    public function salesDetail(){
        $payments = Payment::orderBy('id', 'desc')->paginate(5);
        return view('admin.sale-detail')->with(['payments' => $payments]);
    }

    ///////// See the sales Details////////////////////
    public function seeDetail($ref){
        $payments = Payment::where('ref', $ref)->get();
        $ordered = Ordered::where('payment_ref', $ref)->get();
        return view('admin.see-detail')->with([
            'ordered' => $ordered, 
            'payments' => $payments
            ]);
    
    }

    /////////////// Get all the orders/////////////////////
    public function orders(){
        $orders = Ordered::orderBy('id', 'desc')->paginate(5);
        return view('admin.orders')->with(['orders' => $orders]);
    }

    //////////// Get the most Ordered Items////////////////
    public function mostOrder(){
        $total_pro = Products::all();
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

        return view('admin.most-orders')->with(['orders' => $most_order_output]);
    }


    //////////////////// Get to top most vieewed items/////////////////
    public function topView(){
        $total_pro = Products::all();
         /////////// Most visited///////
         $visit = [];
         $most_visit_output = [];
         foreach($total_pro as $value){
             array_push($visit, $value->visited);
         }
         rsort($visit);
         for($x = 0; $x < count($visit); $x++){
             $currentVisit = Products::where('visited', $visit[$x])->get();
             $currentVisit = $currentVisit[0];
             array_push($most_visit_output, $currentVisit);
         }

         return view('admin.top-view')->with(['views' => $most_visit_output]);
    }


    public function outOfStock(){
        $total_pro = Products::where('stock', '0')->get();
        return view('admin.out-of-stock')->with(['out_of_stock' => $total_pro]);

    }

    ////////// Show users to fund page//////////////
    public function fundUser($id){
      //  $user = User::find($id);
       $user = User::where('userID', $id)->get();
       return view('admin.fund-user')->with(['user' => $user]);
    }

    public function adminFundUser(Request $request){
            
            $trans = userTrans::where('userID', $request->id);
            $userFun = userFund::where('userID', $request->id)->get();

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
                $userTrans->desc = 'admin bonus';
                $userTrans->status = 'paid';
                $userTrans->ref = 'admin'. $userRand;
                $userTrans->date_of_payment = $request->myDate;
                $userTrans->save();

                return "success";
            }else{

                $userTrans = new userTrans;
                $userTrans->userID = $request->id;
                $userTrans->email = $request->email;
                $userTrans->amount = $request->amount;
                $userTrans->desc = 'admin bonus';
                $userTrans->status = 'paid';
                $userTrans->ref = 'admin'. $userRand;
                $userTrans->date_of_payment = $request->myDate;
                $userTrans->save();

                $currentAmount = intval($userFun[0]->amount);
                $newAmount = $request->amount + $currentAmount;
                UserFund::where('userID', $request->id)->update(array('amount' => $newAmount));        

                return "success";
                
            }
            
            
            
    }

    public function fund(){
        $allUser = User::all();
        return view('admin.fund')->with(['users' => $allUser]);
    }

    public function dashboard(){

        
        $total_pro = Products::all();
        $total_user = User::all();
        $total_payment = Payment::all();
        $total_orders = Ordered::all();
        $most_order = Products::max('sold');
        $most_visited = Products::max('visited');

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
     

        /////////// Most visited///////
        $visit = [];
        $most_visit_output = [];
        foreach($total_pro as $value){
            array_push($visit, $value->visited);
        }
        rsort($visit);
        for($x = 0; $x < count($visit); $x++){
            $currentVisit = Products::where('visited', $visit[$x])->get();
            $currentVisit = $currentVisit[0];
            array_push($most_visit_output, $currentVisit);
        }

        
        return view('admin.dashboard')->with(
            ['total_pro' => $total_pro, 
            'total_user' => $total_user,
            'total_payment' => $total_payment,
            'total_orders' => $total_orders,
            'most_order' => $most_order_output,
            'most_visited' => $most_visit_output
            ]
        );
        

       /// return view('admin.dashboard');

        
    }

    public function items(){
        $items = Products::all();
        return view('admin.items')->with('items', $items);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    public function createProduct(Request $request){
        
       // return $request;
        
        $pro = new Products;
        $pro->name = $request->input('name');
        $pro->price = $request->input('price');
        $pro->discount = $request->input('discount');
        $pro->discount_state = $request->input('state');
        $pro->volume = $request->input('volume');
        $pro->brand_name = $request->input('brand');
        $pro->category = $request->input('category');
        $pro->sold = $request->input('sold');
        $pro->stock = $request->input('stock');
        $pro->description = $request->input('desc');
        $pro->view = 'on';
        $pro->star = 0;
        $pro->visited = 0;
        $pro->images = file_get_contents($request->file);
       
        $pro->save();

        return "done";
        


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /*
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'state' => 'required',
            'volume' => 'required',
            'brand_name' => 'required',
            'category' => 'required',
            'product_image' => 'image',
            'sold' => 'required',
            'stock' => 'required',
            'description' => 'required'
        ]);

        */

        ////////handle image

            if($request->hasFile('product_image')){

                ////get de full name
                $fileNameWitExt = $request->file('product_image')->getClientOriginalName();

                //////get only the image name
                $fileName = pathinfo($fileNameWitExt, PATHINFO_FILENAME);

                /////get extension
                $fileExt = $request->file('product_image')->getClientOriginalExtension();

                /////////File name
                $storeName = time().".".$fileExt;

                //////Store file
               // $pathToFile = Storage::disk('public')->put('uploads/', $storeName);
               //// $path = $request->file('product_image')->Storage::disk('public')->put('uploads/', $storeName);
               //  $path = $request->file('product_image')->storeAs(Storage::disk('public'), $storeName);
                
               
                $path = $request->file('product_image')->storeAs('/public/images', $storeName);
               
               
               
                /*

                $response = Http::asForm()->post('https://api.cloudinary.com/v1_1/dqob23x5p/image/upload', [
                    'image' => $request->hasFile('product_image')
                ]);
                $path = $request->file('product_image')->storeAs('/bmunzcvl/image/upload', $storeName);
                */
          
            }

            /*

        $pro = new Products;
        $pro->name = $request->input('name');
        $pro->price = $request->input('price');
        $pro->discount = $request->input('discount');
        $pro->discount_state = $request->input('state');
        $pro->volume = $request->input('volume');
        $pro->brand_name = $request->input('brand_name');
        $pro->category = $request->input('category');
        $pro->sold = $request->input('sold');
        $pro->stock = $request->input('stock');
        $pro->description = $request->input('description');
        $pro->view = 'on';
        $pro->star = 0;
        $pro->visited = 0;
            if($request->hasFile('product_image')){
                $pro->images = $request->hasFile('product_image');
               // $pro->images = $storeName;
            }
        $pro->save();

        return redirect('/admin/create')->with('success', 'Item Added Successfully');

        */

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Products::find($id);
        return view('admin.edit')->with('items', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'volume' => 'required',
            'brand_name' => 'required',
            'category' => 'required',
            'product_image' => 'image',
            'description' => 'required'
        ]);

        

        ////////handle image/////////////

            if($request->hasFile('product_image')){

                $del = Products::find($id)->images;
                Storage::delete('public/images/'.$del);

                ////get de full name
                $fileNameWitExt = $request->file('product_image')->getClientOriginalName();

                //////get only the image name
                $fileName = pathinfo($fileNameWitExt, PATHINFO_FILENAME);

                /////get extension
                $fileExt = $request->file('product_image')->getClientOriginalExtension();

                /////////File name
                $storeName = time().".".$fileExt;

                //////Store file
                $path = $request->file('product_image')->storeAs('/public/images', $storeName);
            }

        $pro = Products::find($id);

        $pro->name = $request->input('name');
        $pro->price = $request->input('price');
        $pro->discount = $request->input('discount');

        if($request->state != ""){
            $pro->discount_state = $request->input('state'); 
        }
        if($request->view != ""){
            $pro->view = $request->input('view');
        }

        $pro->volume = $request->input('volume');
        $pro->brand_name = $request->input('brand_name');
        $pro->category = $request->input('category');
        $pro->description = $request->input('description');
        $pro->sold = $request->input('sold');


            if($request->hasFile('product_image')){
                $pro->images = $storeName;
            }

        $pro->save();

        return redirect('/admin/dashboard')->with('success', 'Item Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Products::find($id);
       // $fileName = $post::find($id)->images;
       // Storage::delete('/images/'.$fileName);
        $post->delete();
       return redirect ('/admin/items')->with('success', 'Product Deleted');
    }
}
