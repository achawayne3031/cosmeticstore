<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Reviews;
use App\Star;
use DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Products::find($id);

        /////////// Update visited //////////
        $current = $item->visited;
        $update = intval($current) + 1;
        Products::where('id', $id)->update(array('visited' => $update));        
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $currentItem = test_input($item->name);

        $ex = explode(" ", $currentItem);
        $related = '';
          $i = 0;
          foreach ($ex as $key => $value) {
                $i++;
                if($i == 1){
                    $related = Products::where('name', 'LIKE', '%' . $value . '%')->take(6)->get();
                }else{
                    $i = $i-1;
                    $related = Products::where('name', 'LIKE', '%' . $value[$i] . '%')->take(6)->get();
                }

            }
         //  return $related;

        
        
        /*
        $currentItem = $item->name;
        $ex = explode(" ", $currentItem);
            $i = 0;
          //  $con = "";
            foreach ($ex as $key => $value) {
                $i++;
                if($i == 1){
                    $related = Products::where('name', 'LIKE', '%' . $value . '%')->take(6)->get();
                }else{
                    $i = $i-1;
                    $related = Products::where('name', 'LIKE', '%' . $value[$i] . '%')->take(6)->get();
                }

            }

            return $related;

            */
            

         $review = Reviews::where('pro_id', $id)->take(4)->get();
         $star = Star::where('pro_id', $id)->get();

        return view('pages.show')->with(['item' => $item, 'relatedPros' => $related, 'reviews' => $review, 'stars' => $star]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
