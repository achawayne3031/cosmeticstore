<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use DB;

class categoryController extends Controller
{


    public function foot(){
        $foots = Products::where('category', 'foot care')->paginate(20);
        return view('pages.foot')->with(['foots' => $foots]);
    }

    
    public function hair(){
        $hairs = Products::where('category', 'hair care')->paginate(20);
        return view('pages.hair')->with(['hairs' => $hairs]);
    }


    public function skin(){
        $skins = Products::where('category', 'skin care')->paginate(20);
        return view('pages.skin')->with(['skins' => $skins]);
    }


    public function face(){
        $faces = Products::where('category', 'face care')->paginate(20);
        return view('pages.face')->with(['faces' => $faces]);
    }


    public function fragrance(){
        $frags = Products::where('category', 'fragrance')->paginate(20);
        return view('pages.fragrance')->with(['frags' => $frags]);
    }


    public function make(){
        $makes = Products::where('category', 'make up')->paginate(20);
        return view('pages.make')->with(['makes' => $makes]);
    }


    public function bath(){
        $baths = Products::where('category', 'bath and body')->paginate(20);
        return view('pages.bath')->with(['baths' => $baths]);
    }


    public function related(Request $request){

        $get = $request->category;
        $load = Products::where('category', $get)->take(3)->get();
        return $load;

    }


    public function send($value){
        return this.$value;
    }


    public function search(){

        $search = request('search');

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
            return $data;
        }

        $search = test_input($search);

        $ex = explode(" ", $search);
            $i = 0;
            $con = "";
            foreach ($ex as $key => $value) {
            $i++;
            if($i == 1){
                $get = Products::where('name', 'LIKE', '%' . $value . '%')->paginate(20);
            }else{
                $i = $i-1;
                $get = Products::where('name', 'LIKE', '%' . $value[$i] . '%')->paginate(20);
            }

        }

        return view('pages.search')->with(['search' => $get, 'input' => $search]);
    }




}
