<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Star;
use App\Reviews;
use App\Products;
use DB;

class StarController extends Controller
{
    //

    public function submitReview(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'review' => 'required',
            'star' => 'required'
        ]);

        $review = new Reviews;
        $star = new Star;
        $product = new Products;

        $id = $request->input('id');
   
        $starDB = DB::select("SELECT * FROM products WHERE id = $id");
        $current = $starDB[0]->star;
        $newStar = $current + $request->input('star');

        Products::where('id', $id)->update(array('star' => $newStar));       
     
        $review->pro_id = $request->input('id');
        $review->name = $request->input('name');
        $review->review = $request->input('review');
        $review->star = $request->input('star');
        $review->save();
        
        $output[] = [
            'success' => true
        ];

        return json_encode($output);

    }
}
