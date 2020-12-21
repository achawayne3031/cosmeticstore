

<?php



    /*


     @foreach ($relatedPros as $relatedPro)
                <div class="col-lg-2 col-xl-2 col-md-2">
                    <a href="/item/{{$relatedPro->id}}" class="related-link">
                        <img src="/storage/images/{{$relatedPro->images}}" alt="" class="img-fluid related-img">
                        <h6 class="related-name">{{$relatedPro->name}}</h6>

                        @php
                            
                            if($relatedPro->discount_state == 'on'){
                                $price = number_format($relatedPro->price, 2);
                                echo "<h6 class='show-discount-price'><span class='naira-text'>NGN </span>$price</h6>";

                                $discount = ($relatedPro->price / $relatedPro->discount);
                                $discount_price = $relatedPro->price - $discount;
                                $discount_price_output = number_format($discount_price, 2);
                                echo "<h6 class='show-dis-price'><span class='naira-text'>NGN </span>$discount_price_output</h6>";
                            }else{
                                $price = number_format($relatedPro->price, 2);
                                echo "<h6 class='show-dis-price'><span class='naira-text'>NGN </span>$price</h6>";
                            }
                            
                        @endphp
                       
                        @php
                          //  $price = number_format($relatedPro->price, 2);
                          //  echo "<h6 class='related-price'><span class='naira-text'>NGN </span>$price</h6>";
                        @endphp
                      
                    </a>
                </div>
        @endforeach
        
        */

    $rel = $_POST['name'];


    echo 'sent';




    @if(count($most_visited) > 0)
    @foreach($most_visited as $key => $value)
        <tr>
            <td><img src="/storage/images/{{ $value->images }}" class="img-fluid"></td>
            <td class="table-content-text">{{ $value->name }}</td>
            <td class="table-content-text">{{ $value->visited }}</td>
            <td class="table-content-text">{{ $value->stock }}</td>
        </tr>
    @endforeach
@endif





///////////// Skin care//////////
@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-xl-3"></div>
        <div class="col-lg-9 col-md-9 col-xl-9 col-sm-10 col-10 offset-sm-1 offset-lg-3 offset-md-3">
            <h6 class="text-center category-title">Skin Care</h6>
            <hr class="category-hr">
            <div class="row">
                @if(count($skins) > 0)
                    @foreach ($skins as $item)
                            <div class="col-lg-3 col-md-4 col-xl-3 col-sm-6 col-6 category-body">
                                <a href="/item/{{$item->id}}" class="text-black">
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12 col-12">
                                        <img src="/storage/images/{{$item->images}}" alt="" class="img-fluid category-img">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12 col-12 pt-2">
                                        @php
                                            if($item->discount_state == 'on'){
                                                echo "<h6 class='on-discount-name'>$item->name</h6>";
                                            }
                                            if($item->discount_state == 'off'){
                                                echo "<h6 class='off-discount-name'>$item->name</h6>";
                                            }

                                            if($item->discount_state == 'on'){
                                                $price = number_format($item->price, 2);
                                                echo "<small class='on-discount-price'><span class='naira-text'>₦</span> $price</small>";

                                                $discount = ($item->price / $item->discount);
                                                $discount_price = $item->price - $discount;
                                                $discount_price_output = number_format($discount_price, 2);
                                                echo "<h6 class='text-bold'><span class='naira-text'>₦</span> $discount_price_output</h6>";
                                            }else{
                                                $price = number_format($item->price, 2);
                                                echo "<h6 class='text-bold'><span class='naira-text'>₦</span> $price</h6>";
                                            }
                                        @endphp
                                    </div>
                                </a>
                            </div>
                    @endforeach

                @else
                    <div class="col-lg-12">
                        <h6 class="alert alert-success text-center category-no-item">No Item On Skin Care</h6>
                    </div>
                @endif
            </div>

             <div class="row mt-3">
                <div class="col-lg-9 d-flex justify-content-center">
                    {{ $skins->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

@endsection






///////////////// searh page ///////////

@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-xl-3"></div>
        <div class="col-lg-9 col-md-9 col-xl-9 col-sm-10 col-10 offset-sm-1 offset-lg-3 offset-md-3">
            <h6 class="text-center category-title"> result found From <b>{{$input}}</b></h6>
            <hr>
            <div class="row">
                @if (count($search) > 0)
                    @foreach ($search as $item)
                        <div class="col-lg-3 col-md-4 col-xl-3 col-sm-6 col-6 category-body">
                            <a href="/item/{{$item->id}}" class="text-black">
                            <img src="/storage/images/{{$item->images}}" alt="" class="img-fluid search-img">
                            @php

                                if($item->discount_state == 'on'){
                                    echo "<h6 class='search-name-on-discount'>$item->name</h6>";
                                }
                                if($item->discount_state == 'off'){
                                    echo "<h6 class='search-name-off-discount'>$item->name</h6>";
                                }

                                if($item->discount_state == 'on'){
                                    $price = number_format($item->price, 2);
                                    echo "<h6 class='show-discount-price mt-2'><span class='naira-text'>₦ </span>$price</h6>";

                                    $discount = ($item->price / $item->discount);
                                    $discount_price = $item->price - $discount;
                                    $discount_price_output = number_format($discount_price, 2);
                                    echo "<h6 class='show-dis-price mt-2'><span class='naira-text'>₦ </span>$discount_price_output</h6>";
                                }else{
                                    $price = number_format($item->price, 2);
                                    echo "<h6 class='show-dis-price mt-2'><span class='naira-text'>₦ </span>$price</h6>";
                                }
                            @endphp
                            </a>
                        </div>

                    @endforeach

                    @else
                        <div class="col-lg-12">
                            <h6 class="alert alert-danger text-center category-no-item">No Result Found</h6>
                        </div>
                @endif
            </div>


            <div class="row mt-3">
                <div class="col-lg-9 d-flex justify-content-center">
                    {{ $search->links() }}
                </div>
            </div>





        </div>
    </div>
</div>







@endsection
